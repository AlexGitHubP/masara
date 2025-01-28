<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Mail\ClientMail;
use App\Mail\ShopMail;
use App\Mail\ShopInvoiceNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Account;
use App\Models\StripePayment;
use Locomotif\Shop\Models\FgoApi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class Cart extends Model{

    static function arraysMatch($array1, $array2){
        $keysToIgnore = ['_token', 'amount', 'name', 'main_url', 'mainImg', 'operation'];

        foreach ($array1 as $key => $value) {
            if (in_array($key, $keysToIgnore)) {
                continue;
            }

            if (!array_key_exists($key, $array2) || $array1[$key] !== $array2[$key]) {
                return false;
            }
        }

        return true;
    }

    static function extractTVA($total, $tva, $tvaType){
        $tva   = (double)$tva;
        $total = (double)$total;

        switch ($tvaType) {
            case 'percent':
                $tvaPrice = ($tva/100) * $total;
                break;

            case 'fixed':
                $tvaPrice = $tva;
                break;

            default:
                $tvaPrice = ($tva/100) * $total;
                break;
        }

        return $tvaPrice;
    }
    static function getSubTotalWithTVA($total, $tva){
        $tva   = (double)$tva;
        $total = (double)$total;
        $subTotalWithTva = $tva + $total;

        return (double)$subTotalWithTva;
    }

    static function calculateCarrierFee($subtotalWithoutTVA){
        $subtotalWithoutTVA = (double)$subtotalWithoutTVA;
        $selectedCarrier = self::getOrderPaymentAndCarrierFromSession();

        if(isset($selectedCarrier) && empty($selectedCarrier)){
            $carrier = DB::table('carriers_type')
                    ->select('price', 'free_ship_after')
                    ->where('is_default', '=', '1')
                    ->first();
        }else{
            $carrier = DB::table('carriers_type')
                    ->select('price', 'free_ship_after')
                    ->where('id', '=', (int)$selectedCarrier['carrier_id'])
                    ->first();
        }
        if(isset($carrier->free_ship_after) && !empty($carrier->free_ship_after)){
            $carrierFee = ($subtotalWithoutTVA >= $carrier->free_ship_after) ? 0 : $carrier->price;
        }else{
            dd('Setează carrier si tip carrier pentru shop.');
        }


        return (double)$carrierFee;
    }

    static function getTVA(){
        $tva = DB::table('shop_settings')->select('tva', 'tax_type')->where('id', 1)->first();
        return $tva;
    }

    static function calculateTotalForCart($cartProducts){
        if(isset($cartProducts) && !empty($cartProducts) && count($cartProducts)>0){
            $tva = self::getTVA();
            $subtotal = 0;
            foreach ($cartProducts as $key => $value) {
                $price  = (int)$value['price'];
                $amount = (int)$value['amount'];
                $totalProduct = $price * $amount;
                $subtotal = $subtotal + $totalProduct;
            }

            if(isset($tva->tax_type) && !empty($tva->tax_type)){

                //Todo, sa se calculeze TVA corect si sa se trimita in FGO corect 50% din valoare fara TVA
                $realDeliveryFee         = self::calculateCarrierFee($subtotal);
                $realTotalWithoutTVA     = $subtotal + $realDeliveryFee;
                $realExtractedTVA        = self::extractTVA($realTotalWithoutTVA, $tva->tva, $tva->tax_type);
                $realTotal               = $realTotalWithoutTVA + $realExtractedTVA;
                $realHalfOrderWithoutTVA = $realTotalWithoutTVA / 2;
                $realHalfOrderWithTVA    = $realHalfOrderWithoutTVA + self::extractTVA($realHalfOrderWithoutTVA, $tva->tva, $tva->tax_type);


                //dd($realTotalWithoutTVA, $realHalfOrderWithoutTVA, $realTotal, $realHalfOrderWithTVA);
                // $extractedTVA    = self::extractTVA($subtotal, $tva->tva, $tva->tax_type);
                // $subtotalWithTVA = self::getSubTotalWithTVA($subtotal, $extractedTVA);
                // $deliveryFee     = self::calculateCarrierFee($subtotalWithTVA);
                // $totalOrder      = $subtotalWithTVA + $deliveryFee;
                // $subtotalWithoutTVA  = $subtotal + $deliveryFee;
                // $halfOrderWithoutTVA = $subtotalWithoutTVA / 2;
                // $halfOrderWithTVA    = $halfOrderWithoutTVA + self::extractTVA($halfOrderWithoutTVA, $tva->tva, $tva->tax_type);



                //dd($subtotal, $extractedTVA, $subtotalWithTVA, $deliveryFee, $totalOrder, $subtotalWithoutTVA, $halfOrderWithoutTVA, $halfOrderWithTVA);

                // echo '<pre>';print_r($total);
                // echo '<pre>';print_r(self::extractTVA($halfWithoutTVA, $tva->tva, $tva->tax_type));exit;

                $tvaData = array(
                    'calculatedTva'       => round($realExtractedTVA, 2),
                    'subtotal'            => round($subtotal, 2),
                    'deliveryFee'         => round($realDeliveryFee, 2),
                    'totalOrder'          => round($realTotal, 2),
                    'tva'                 => $tva->tva,
                    'tvaType'             => $tva->tax_type,
                    'halfOrderWithoutTVA' => round($realHalfOrderWithoutTVA, 2),
                    'halfOrderWithTVA'    => round($realHalfOrderWithTVA, 2),
                );

            }else{
                dd('Nu este setat TVA-ul in shop');
            }

        }else{
            return array();
        }

        return $tvaData;
    }


    static function getCart(){
        $cartItems = request()->session()->get('cartProduct');
        $cartItems = (!isset($cartItems)) ? array() : $cartItems;

        $response = array(
            'cartItems' => $cartItems,
            'totalCart' => self::calculateTotalForCart($cartItems)
        );

        return $response;
    }
    static function buildPaymentDetails($originalOrderDetails){
        $paymentDetails = array(
            'carrier_id'   => (int)$originalOrderDetails['carrier'],
            'paymethod_id' => (int)$originalOrderDetails['paymethod']
        );
        return $paymentDetails;
    }

    static function buildJuridicOrder($originalOrderDetails){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $orderDetails = array(
            'order_id'         => 0,
            'is_billing'       => 1,
            'is_company'       => 1,
            'name'             => $originalOrderDetails['name'],
            'surname'          => $originalOrderDetails['surname'],
            'email'            => $originalOrderDetails['email'],
            'phone'            => $originalOrderDetails['phone'],
            'street'           => $originalOrderDetails['street'],
            'nr'               => $originalOrderDetails['nr'],
            'bloc'             => $originalOrderDetails['bloc'],
            'scara'            => $originalOrderDetails['scara'],
            'apartament'       => $originalOrderDetails['apartament'],
            'city'             => $originalOrderDetails['city'],
            'county'           => $originalOrderDetails['county'],
            'country'          => $originalOrderDetails['country'],
            'zip_code'         => $originalOrderDetails['zip_code'],
            'comments'         => '',
            'company_name'     => $originalOrderDetails['company_name'],
            'company_type'     => $originalOrderDetails['company_type'],
            'company_vat_type' => $originalOrderDetails['company_vat_type'],
            'company_cui'      => $originalOrderDetails['company_cui'],
            'company_j'        => $originalOrderDetails['company_j'],
            'company_nr'       => $originalOrderDetails['company_nr'],
            'company_series'   => $originalOrderDetails['company_series'],
            'company_year'     => $originalOrderDetails['company_year'],
            'created_at'       => $now,
            'updated_at'       => $now,
        );
        return $orderDetails;
    }

    static function buildFizicOrder($originalOrderDetails){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $orderDetails = array(
            'order_id'         => 0,
            'is_billing'       => 1,
            'is_company'       => 0,
            'name'             => $originalOrderDetails['name'],
            'surname'          => $originalOrderDetails['surname'],
            'email'            => $originalOrderDetails['email'],
            'phone'            => $originalOrderDetails['phone'],
            'street'           => $originalOrderDetails['street'],
            'nr'               => $originalOrderDetails['nr'],
            'bloc'             => $originalOrderDetails['bloc'],
            'scara'            => $originalOrderDetails['scara'],
            'apartament'       => $originalOrderDetails['apartament'],
            'city'             => $originalOrderDetails['city'],
            'county'           => $originalOrderDetails['county'],
            'country'          => $originalOrderDetails['country'],
            'zip_code'         => $originalOrderDetails['zip_code'],
            'comments'         => '',
            'company_name'     => '',
            'company_type'     => '',
            'company_vat_type' => '',
            'company_cui'      => '',
            'company_j'        => '',
            'company_nr'       => '',
            'company_series'   => '',
            'company_year'     => '',
            'created_at'       => $now,
            'updated_at'       => $now,
        );
        return $orderDetails;
    }

    static function buildOrderDetails($originalOrderDetails){
        if(isset($originalOrderDetails) && !empty($originalOrderDetails)){
            switch ($originalOrderDetails['person_type']) {
                case 'fizica':
                    $success = true;
                    $message = 'OrderDetail fizic build done.';
                    $orderDetails   = self::buildFizicOrder($originalOrderDetails);
                    $paymentDetails = self::buildPaymentDetails($originalOrderDetails);
                    break;
                case 'juridica':
                    $success = true;
                    $message = 'OrderDetail juridic done.';
                    $orderDetails = self::buildJuridicOrder($originalOrderDetails);
                    $paymentDetails = self::buildPaymentDetails($originalOrderDetails);
                    break;
                default:
                    $success = false;
                    $message = 'A intervenit o eroare la creearea detaliilor de comandă. Vă rugăm încercați din nou.';
                    $orderDetails = null;
                    $paymentDetails = null;
                    break;
            }
            $response = array(
                'success'                => $success,
                'type'                   => 'orderDetailAdded',
                'message'                => $message,
                'returnedResponse'       => $orderDetails,
                'returnedPaymentDetails' => $paymentDetails
            );
        }else{
            $response = array(
                'success'=>false,
                'type'   => 'orderDetailAdded',
                'message'=>'Adaugă detaliile comenzii.',
                'returnedResponse' => null,
                'returnedPaymentDetails' => null
            );
        }

        return $response;
    }

    static function putOrderDetailsToSession($orderDetails){
        if(isset($orderDetails) && !empty($orderDetails)){
            Session::put('orderDetails', $orderDetails);
            $response = array(
                'success'=>true,
                'type'   => 'orderDetailAdded',
                'message'=>'Detalii facturare adaugate in sesiune cu success.',
                'returnedResponse' => $orderDetails
            );
        }else{
            Session::forget('orderDetails');
            $response = array(
                'success'=>false,
                'type'   => 'orderDetailAdded',
                'message'=>'A intervenit o eroare la adaugarea detaliilor in sesiune. Vă rugăm încercați din nou.',
                'returnedResponse' => null
            );

        }

        return $response;

    }

    static function putOrderPaymentAndCarrierToSession($paymentAndCarrierDetails){
        if(isset($paymentAndCarrierDetails) && !empty($paymentAndCarrierDetails)){
            Session::put('orderPaymentAndCarrierToSession', $paymentAndCarrierDetails);
            $response = array(
                'success'=>true,
                'type'   => 'orderDetailAdded',
                'message'=>'Detalii plata si transport adaugate in sesiune cu success.',
                'returnedResponse' => $paymentAndCarrierDetails
            );
        }else{
            Session::forget('orderDetails');
            $response = array(
                'success'=>false,
                'type'   => 'orderDetailAdded',
                'message'=>'A intervenit o eroare la adaugarea detaliilor de plata si transport in sesiune. Vă rugăm încercați din nou.',
                'returnedResponse' => null
            );

        }

        return $response;
    }

    static function getActiveCarriers(){
        $carriers = DB::table('carriers')
                        ->select('*')
                        ->where('status', '=', 'published')
                        ->orderBy('ordering', 'ASC')
                        ->get();
        $carriers->map(function($carrier){
            $carrier->type = DB::table('carriers_type')
                                    ->select('*')
                                    ->where('status', '=', 'published')
                                    ->where('carrier_id', '=', $carrier->id)
                                    ->orderBy('ordering', 'ASC')
                                    ->get();
        });
        return $carriers;
    }

    static function getTransactionProviders(){
        $transactionProviders = DB::table('transactions_providers')
                                    ->select('*')
                                    ->where('status', '=', 'published')
                                    ->orderBy('ordering', 'ASC')
                                    ->get();

        if(!isset($transactionProviders) || count($transactionProviders)<=0){
            dd('Setează o metodă de plată în shop.');
        }
        return $transactionProviders;
    }


    static function getOrderDetails(){

        $orderDetails = request()->session()->get('orderDetails');
        $orderDetails = (!isset($orderDetails)) ? array() : $orderDetails;

        return $orderDetails;
    }
    static function getOrderPaymentAndCarrierFromSession(){

        $orderPaymentAndCarrierToSession = request()->session()->get('orderPaymentAndCarrierToSession');
        $orderPaymentAndCarrierToSession = (!isset($orderPaymentAndCarrierToSession)) ? array() : $orderPaymentAndCarrierToSession;

        return $orderPaymentAndCarrierToSession;
    }

    static function getPayProviderInfos($paymethodID){
        $provider = DB::table('transactions_providers')
                    ->select('*')
                    ->where('id', '=', (int)$paymethodID)
                    ->first();
        return $provider;
    }

    static function generateOrderReference(){
        return Str::random(10);
    }

    static function buildAddress($orderDetails){

        $city       = (isset($orderDetails['city'])       && !empty($orderDetails['city']))       ? 'Loc. '.$orderDetails['city']             : '';
        $street     = (isset($orderDetails['street'])     && !empty($orderDetails['street']))     ? ', Str. '.$orderDetails['street']         : '';
        $nr         = (isset($orderDetails['nr'])         && !empty($orderDetails['nr']))         ? ', Nr. '.$orderDetails['nr']              : '';
        $bloc       = (isset($orderDetails['bloc'])       && !empty($orderDetails['bloc']))       ? ', Bl. '.$orderDetails['bloc']            : '';
        $scara      = (isset($orderDetails['scara'])      && !empty($orderDetails['scara']))      ? ', Sc. '.$orderDetails['scara']           : '';
        $apartament = (isset($orderDetails['apartament']) && !empty($orderDetails['apartament'])) ? ', Ap. '.$orderDetails['apartament']      : '';
        $zip_code   = (isset($orderDetails['zip_code'])   && !empty($orderDetails['zip_code']))   ? ', Cod Postal '.$orderDetails['zip_code'] : '';

        $address = $city.$street.$nr.$bloc.$scara.$apartament.$zip_code;

        return $address;
    }


    static function generateLocomotifInvoice($paymentProvider, $orderDetails, $cartItems){

        $shopDetails             = self::getShopDetails();
        $orderDetails['address'] = self::buildAddress($orderDetails);

        $template = ($orderDetails['is_company'] == 1) ? 'cart.invoices.companyInvoice' : 'cart.invoices.regularInvoice';

        $pdf = Pdf::loadView($template, [
            'paymentProvider' => $paymentProvider,
            'orderDetails'    => $orderDetails,
            'cartInfos'       => $cartItems,
            'shopDetails'     => $shopDetails
        ]);

        $pdfName = Str::random(30);
        $pdfName = $pdfName.'.pdf';

        $storageResponse = Storage::put('public/pdf/'.$pdfName, $pdf->output());

        if($storageResponse){
            return $pdfName;
        }else{
            return false;
        }

    }

    static function buildFGOOrderDetails($orderDetails, $paymentDetails){

        $isCompany = $orderDetails['is_company'];
        $address   = self::buildAddress($orderDetails);
        $registru  = $orderDetails['company_j'].$orderDetails['company_nr'].'/'.$orderDetails['company_series'].'/'.$orderDetails['company_year'];
        $cui       = $orderDetails['company_vat_type'].$orderDetails['company_cui'];

        $clientCompany        = ($isCompany) ? $orderDetails['company_name'] : $orderDetails['name'].' '.$orderDetails['surname'];
        $clientCUI            = ($isCompany) ? $cui : '';
        $clientType           = ($isCompany) ? 'PJ' : 'PF';
        $clientRegistruComert = ($isCompany) ? $registru : '';
        $clientCounty         = $orderDetails['county'];
        $clientEmail          = $orderDetails['email'];
        $clientPhone          = $orderDetails['phone'];
        $clientCity           = $orderDetails['city'];
        $clientAddress        = $address;


        switch ($paymentDetails->type) {
            case 'online':
                $invoiceType = 'Factura';
                $series      = 'ACT';
            break;

            case 'moneyOrderAdvance':
                $invoiceType = 'Proforma';
                $series      = 'PF';
            break;

            default:
                $invoiceType = 'Factura';
                $series      = 'ACT';
            break;
        }


        $orderDetailsFgo = [
            'currency'             => 'RON',
            'series'               => $series,
            'invoiceType'          => $invoiceType,
            'clientCompany'        => $clientCompany,
            'clientCUI'            => $clientCUI,
            'clientType'           => $clientType,
            'clientRegistruComert' => $clientRegistruComert,
            'clientCounty'         => $clientCounty,
            'clientEmail'          => $clientEmail,
            'clientPhone'          => $clientPhone,
            'clientCity'           => $clientCity,
            'clientAddress'        => $clientAddress,
            // 'shopOrderReference'   => $orderReference,
        ];

        return $orderDetailsFgo;
    }

    static function getProductSubtotal($pricePerUnit, $totalUnits){
        $subtotal = (int)$pricePerUnit * (int)$totalUnits;
        return $subtotal;
    }

    static function getDesignerIDOfProduct($productID){
        $isMasaraProd = Products::where('id', $productID)->where('product_type', 'simple')->exists();
        if($isMasaraProd){
            $designerID = DB::table('products')->select('designer_id')->where('id', '=', $productID)->get()->first();
        }else{
            $designerID = DB::table('products')->select('designer_id')->where('id', '=', $productID)->get()->first();
        }

        $designerID = $designerID->designer_id;
        return $designerID;
    }

    static function checkAndBuildCarrierFee($carrierTypeID, $subtotal){

        $carrier = DB::table('carriers_type')
                    ->select('price', 'free_ship_after')
                    ->where('id', '=', (int)$carrierTypeID)
                    ->first();

        $hasCarrierFee = ($subtotal >= $carrier->free_ship_after) ? false : true;

        if($hasCarrierFee){
            $carrierItem = array(
                array(
                    "name"           => "Servicii de transport",
                    "quantity"       => 1,
                    "subtotal"       => (string)$carrier->price,
                    "price_per_unit" => (string)$carrier->price,
                    "um" => 'lei'
                )
            );
        }else{
            $carrierItem = '';
        }

        $response['addCarrierFee'] = $hasCarrierFee;
        $response['carrierItem']   = $carrierItem;

        return $response;

    }

    static function createOrder($paymentAndCarrierDetails, $orderDetails, $cartItems, $account){

        try{
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $reference       = self::generateOrderReference();
            $paymentProvider = self::getPayProviderInfos($paymentAndCarrierDetails['paymethod_id']);
            $orderDetailsFgo = self::buildFGOOrderDetails($orderDetails, $paymentProvider);
            $hasCarrierFee   = self::checkAndBuildCarrierFee($paymentAndCarrierDetails['carrier_id'], $cartItems['totalCart']['subtotal']);
            $fgoItems        = ($hasCarrierFee['addCarrierFee']) ? array_merge($cartItems['cartItems'],$hasCarrierFee['carrierItem']) : $cartItems['cartItems'];

        //instantiateFGO

            $fgoInstance     = new FgoApi($orderDetailsFgo);
            $invoice         = $fgoInstance->generateInvoice($fgoItems, $paymentProvider->type, $cartItems['totalCart']['halfOrderWithoutTVA']);
            $invoiceID       = $fgoInstance->storeInvoice($invoice, $paymentProvider->type);
        }catch (\Exception $e){
            self::generateLocomotifInvoice($paymentProvider, $orderDetails, $cartItems);
            Log::error($e);
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => array('A intervenit o eroare la plasarea comenzii. Te rugam incearca din nou sau contacteaza-ne.')
            ], 422);
        }

        try {
            $orderID = DB::table('orders')->insertGetId([
                'user_id'      => (int)$account->id,
                'reference'    => $reference,
                'carrier_id'   => (int)$paymentAndCarrierDetails['carrier_id'],
                'invoice_id'   => $invoiceID,
                'paymethod_id' => (int)$paymentAndCarrierDetails['paymethod_id'],
                'user_account' => 'createdAtCheckout',
                'subtotal'     => $cartItems['totalCart']['subtotal'],
                'discount'     => 0,
                'delivery_fee' => $cartItems['totalCart']['deliveryFee'],
                'total'        => $cartItems['totalCart']['totalOrder'],
                'tva'          => $cartItems['totalCart']['calculatedTva'],
                'currency'     => 'RON',
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);

            $orderDetails['order_id'] = $orderID;
            DB::table('orders_details')->insert($orderDetails);

            foreach ($cartItems['cartItems'] as $key => $product) {

                $designerID = self::getDesignerIDOfProduct($product['id']);
                $insertItem['order_id']       = (int)$orderID;
                $insertItem['product_id']     = (int)$product['id'];
                $insertItem['designer_id']    = (int)$designerID;
                $insertItem['name']           = $product['name'];
                $insertItem['quantity']       = (int)$product['amount'];
                $insertItem['subtotal']       = self::getProductSubtotal($product['price'], (int)$product['amount']);
                $insertItem['price_per_unit'] = $product['price'];
                $insertItem['created_at'] = $now;
                $insertItem['updated_at'] = $now;

                DB::table('orders_items')->insert($insertItem);
            }

            $orderTrackingID = DB::table('orders_tracking')->insertGetId([
                'order_id'        => $orderID,
                'delay_time_days' => '0',
                'comments'        => null,
                'status'          => 'sentToShop',
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);

            $moneyOrderDetails = Session::get('moneyOrderDetails', []);
            $carrier = self::getCarrier($paymentAndCarrierDetails['carrier_id']);

            //self::sendMailClient($orderDetails, $reference, $cartItems, $carrier, $paymentProvider);
            //self::sendMailShop($orderDetails, $reference, $cartItems, $carrier, $paymentProvider);
            // self::sendMailShop();
            // self::sendMailDesigner();

            if($paymentProvider->type=='online'){
                $response = array(
                    'type'           => 'online',
                    'success'        => true,
                    'orderReference' => $reference,
                    'orderID'        => $orderID,
                    'userID'         => $account->id,
                    'paymethodID'    => $paymentAndCarrierDetails['paymethod_id']
                );
            }else{
                $response = array(
                    'type'           => 'moneyOrder',
                    'success'        => true,
                    'orderReference' => $reference,
                    'orderID'        => $orderID,
                    'userID'         => $account->id,
                    'paymethodID'    => $paymentAndCarrierDetails['paymethod_id']
                );
            }

            Session::put('accountID', $account->id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => array('A intervenit o eroare la plasarea comenzii. Te rugam incearca din nou sau contacteaza-ne.')
            ], 422);
        }


        return $response;

    }

    static function setTransaction($payIntentDetails, $orderDetails){
        $transactionIdentifier = (isset($payIntentDetails->id) && !empty($payIntentDetails->id)) ? $payIntentDetails->id : 'payFirstHalf';
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $transactionID = DB::table('transactions')->insertGetId([
            'order_id'               => (int)$orderDetails['orderDetails']['orderID'],
            'provider_id'            => (int)$orderDetails['orderDetails']['paymethodID'],
            'user_id'                => (int)$orderDetails['orderDetails']['userID'],
            'transaction_identifier' => $transactionIdentifier,
            'comments'               => '',
            'type'                   => $orderDetails['orderDetails']['type'],
            'status'                 => 'transactionFirstHalfRecieved',
            'created_at'             => $now,
            'updated_at'             => $now,
        ]);


        return $transactionID;
    }

    static function getTransactionByPayId($payResponse){
        $transactionDetails = DB::table('transactions')
                                ->select('*')
                                ->where('transaction_identifier', '=', $payResponse['id'])
                                ->get()
                                ->last();

        return $transactionDetails;
    }

    static function checkPaymentStatus($transactionDetails, $status){
        $exists = DB::table('transactions')
                    ->select('transaction_identifier', 'status')
                    ->where('transaction_identifier', '=', $transactionDetails->transaction_identifier)
                    ->where('status', '=', $status)
                    ->exists();

        return $exists;
    }

    static function updateTransaction($transactionDetails, $payResponse){
        $now = Carbon::now()->format('Y-m-d H:i:s');

        switch ($payResponse['status']) {
            case 'succeeded':
               $status = 'paymentConfirmed';
                break;
            case 'processing':
                $status = 'processing';
                break;
            case 'requires_payment_method':
                $status = 'requiresPaymentMethod';
                break;
            case 'payment_failed':
                $status = 'paymentFailed';
                break;

            default:
                $status = 'processing';
                break;
        }


        $transactionID = DB::table('transactions')->insertGetId([
            'order_id'               => (int)$transactionDetails->order_id,
            'provider_id'            => (int)$transactionDetails->provider_id,
            'user_id'                => (int)$transactionDetails->user_id,
            'transaction_identifier' => $payResponse['id'],
            'comments'               => '',
            'type'                   => 'payment',
            'status'                 => $status,
            'created_at'             => $now,
            'updated_at'             => $now,
        ]);

        return $transactionID;
    }

    static function getShopInfos(){
        $shopInfos = DB::table('shop_settings')->select('*')->first();
        return $shopInfos;
    }

    static function getOrderHalfPrice($orderID){
        $orderTotal = DB::table('orders')->select('total')->where('id', '=', $orderID)->first();
        $orderHalf = $orderTotal->total / 2;
        return $orderHalf;
    }

    static function buildMoneyOrder($orderDetails){

        $transactionID      = self::setTransaction(null, $orderDetails);
        $shopDetails        = self::getShopInfos();
        $transactionDetails = self::getPayProviderInfos($orderDetails['orderDetails']['paymethodID']);
        $orderHalfPrice     = self::getOrderHalfPrice($orderDetails['orderDetails']['orderID']);

        $moneyOrderInfos = array(
            'orderReference' => $orderDetails['orderDetails']['orderReference'],
            'shopName'       => $shopDetails->brand_name,
            'shopContact'    => $shopDetails->brand_contact,
            'shopIBAN'       => $transactionDetails->IBAN,
            'shopBank'       => $transactionDetails->bank_name,
            'payNow'         => $orderHalfPrice
        );
        return $moneyOrderInfos;
    }

    static function putMoneyOrderToSession($moneyOrderDetails){
        Session::put('moneyOrderDetails', $moneyOrderDetails);
        return true;
    }

    static function getShopDetails(){
        $shopDetails = DB::table('shop_settings')->select('*')->get()->first();
        $shopDetails->brand_logo = public_path($shopDetails->brand_logo);

        return $shopDetails;
    }

    static function getCarrier($carrierID){
        $carrier = DB::table('carriers_type')
                    ->select('name')
                    ->where('id', '=', (int)$carrierID)
                    ->first();
        return $carrier;
    }

    static function getInvoiceLink($orderID){
        $invoiceLink = DB::table('orders_invoices')
                            ->select('invoice_link')
                            ->where('id', '=', (int)$orderID)
                            ->first();
        return $invoiceLink;
    }

    static function sendMailClient($orderDetails, $reference, $cartItems, $carrier, $paymentProvider){
        $orderDetails['address'] = self::buildAddress($orderDetails);
        if(isset($paymentProvider->type) && !empty($paymentProvider->type) && $paymentProvider->type=='moneyOrderAdvance'){
            $shopInfos = self::getShopDetails();
            $orderDetails['shopInfos'] = $shopInfos;
        }
        if(isset($orderDetails['is_company']) && !empty($orderDetails['is_company']) && $orderDetails['is_company']==true){
            $invoiceLink = self::getInvoiceLink($orderDetails['order_id']);
            $orderDetails['invoiceLink'] = $invoiceLink->invoice_link;
        }

        Mail::to('p.alexandruadrian@yahoo.com')->send(new ClientMail($orderDetails, $reference, $cartItems, $carrier, $paymentProvider));
    }

    static function sendMailShop($orderDetails, $reference, $cartItems, $carrier, $paymentProvider){
        $orderDetails['address'] = self::buildAddress($orderDetails);
        Mail::to('p.alexandruadrian@yahoo.com')->send(new ShopMail($orderDetails, $reference, $cartItems, $carrier, $paymentProvider));
    }

    static function sendShopInvoiceNotification($accountID){
        $account = DB::table('accounts')->where('id', $accountID)->first();
        Mail::to('p.alexandruadrian@yahoo.com')->send(new ShopInvoiceNotification($account));
    }



}
