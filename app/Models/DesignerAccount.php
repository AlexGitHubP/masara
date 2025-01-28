<?php

namespace App\Models;

use App\Models\Products as Prods;
use App\Models\Account as AccountModel;
use App\Models\Cart as CartModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Locomotif\Products\Models\Products;
use Locomotif\Media\Models\Media;
use Locomotif\Admin\Models\Users;


class DesignerAccount extends Model implements Authenticatable{

    protected $baseUrl = '/produse';
    protected $designerUrl = '/designeri';
    protected $table = 'accounts';

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        // Retrieve the password from the associated user
        $user = $this->user()->first();
        return $user ? $user->password : null;
    }

    public function getRememberToken()
    {
        return $this->user()->first()->getRememberToken();
    }

    public function setRememberToken($value)
    {
        $this->user()->first()->setRememberToken($value);
    }

    public function getRememberTokenName()
    {
        return $this->user()->first()->getRememberTokenName();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Prods::class);
    }
    static function mapStatus($status){
        switch ($status) {
            case 'pending':
                $nice = 'În așteptare';
                break;

            case 'hidden':
                $nice = 'Nepublicat';
                break;

            case 'published':
                $nice = 'Publicat';
                break;

            default:
                $nice = 'În așteptare';
                break;
        }

        return $nice;
    }

    static function getDesignerUrl($designer){
        $url = (new self())->designerUrl;

        if ($designer) {
            $url .= '/' . $designer->url.'.html';
        }

        return $url;

    }

    static function getProductCategory($productID){

        $prodToCat = DB::table('products_to_categories')
                        ->select('category_id')
                        ->where('product_id', $productID)
                        ->first();
        if(isset($prodToCat) && !empty($prodToCat)){
            $category = DB::table('products_categories')
                            ->where('id', $prodToCat->category_id)
                            ->first();
        }else{
            $category = null;
        }

        return $category;
    }

    static function getProductSubcategory($productID){
        $prodToSubcat = DB::table('products_to_subcategories')
                        ->select('subcategory_id')
                        ->where('product_id', $productID)
                        ->first();
        if(isset($prodToSubcat) && !empty($prodToSubcat)){
            $subcategory = DB::table('products_subcategories')
                            ->where('id', $prodToSubcat->subcategory_id)
                            ->first();
        }else{
            $subcategory = null;
        }

        return $subcategory;
    }

    static function buildProductUrl($product, $category, $subcategory){
        $url = (new self())->baseUrl;
        if ($category) {
            $url .= '/' . $category->category_url;
            if ($subcategory) {
                $url .= '/' . $subcategory->subcategory_url;
            }
        }
        $url .= '/'.$product->url.'.html';

        return $url;
    }

    static function checkIfBillingExists($designerID){

        $exists = DB::table('account_addresses')->where([
            ['account_id',        '=', $designerID],
            ['is_billing_address', '=', 1]
        ])->exists();

        return $exists;
    }
    static function getAssocValues($attr_id){
        $attributes = DB::table('products_attributes_values')->groupBy('attr_value_identifier')->having('attr_id', '=', $attr_id)->get();
        return $attributes;
    }
    static function getGroupedAssocValues($attr_identifier){
        $attr_values = DB::table('products_attributes_values')->where('attr_value_identifier', '=', $attr_identifier)->get();
        return $attr_values;
    }
    static function getDesignerProducts($designerID, $pagination=4){
        $products = DB::table('products')
                ->where('designer_id', $designerID)
                ->orderBy('ordering', 'DESC')
                ->paginate($pagination);

        $products->map(function($product){
            $category = self::getProductCategory($product->id);
            $subcategory = self::getProductSubcategory($product->id);
            $product->name =  Str::limit($product->name, 20);
            $product->mainImg  = Media::getMainImage('products', $product->id);
            $product->main_url = self::buildProductUrl($product, $category, $subcategory);
            $product->product_status_nice = self::mapStatus($product->product_status);
        });


        return $products;
    }
    static function getMostPopularProductsByDesigner($designerID){
        $products = DB::table('products')
                        ->leftJoin('products_hits', 'products.id', '=', 'products_hits.product_id')
                        ->select('products.*', DB::raw('COUNT(products_hits.product_id) AS total_hits'))
                        ->where('products.designer_id', $designerID)
                        ->groupBy('products.id')
                        ->orderBY('total_hits', 'DESC')
                        ->limit(10)
                        ->get();
        $products->map(function($product){

            $category = self::getProductCategory($product->id);
            $subcategory = self::getProductSubcategory($product->id);
            $product->name =  Str::limit($product->name, 20);
            $product->mainImg  = Media::getMainImage('products', $product->id);
            $product->main_url = self::buildProductUrl($product, $category, $subcategory);
            $product->product_status_nice = self::mapStatus($product->product_status);
        });


        return $products;
    }


    static function nrSalesPerDay($day, $productsIDs){

        $productsByDay = DB::table('orders_items')
                            ->selectRaw('SUM(quantity) as total_quantity')
                            ->whereRaw('DATE(created_at) = ?', $day)
                            ->whereIn('product_id', $productsIDs)
                            ->get()->first();

        $saleQuantity = (isset($productsByDay->total_quantity) && empty($productsByDay->total_quantity) || $productsByDay->total_quantity == null) ? 0 : $productsByDay->total_quantity;

        return $saleQuantity;
    }

    static function getRangeDays($days){
        $endDate   = Carbon::now()->endOfDay();
        $startDate = Carbon::now()->subDays($days)->startOfDay();

        $dateRange = collect(Carbon::parse($startDate)->daysUntil($endDate)->toArray())
            ->map(function ($date) {
                $obj = new \stdClass();
                $obj->day = $date->format('Y-m-d');
                return $obj;
            });

        $lastDays = $dateRange->sortByDesc('day')->values();

        return $lastDays;
    }

    static function getRangeDaysOffset($days){

        $offset = (int)$days + (int)$days + 1;
        $startDate = Carbon::now()->subDays($offset)->startOfDay();
        $endDate   = Carbon::now()->subDays($days + 1)->endOfDay();

        $dateRange = collect(Carbon::parse($startDate)->daysUntil($endDate)->toArray())
            ->map(function ($date) {
                $obj = new \stdClass();
                $obj->day = $date->format('Y-m-d');
                return $obj;
            });

        $lastDays = $dateRange->sortByDesc('day')->values();

        return $lastDays;
    }

    static function formatDay($dateTime, $month, $day){

        $carbonDate = Carbon::parse($dateTime);
        $monthName  = $carbonDate->format($month);  // Month name (e.g., August)
        $dayNumber  = $carbonDate->format($day);
        $format     = $monthName.' '.$dayNumber;

        return $format;
    }

    static function getInitialDesignerSalesNrByDay($designerID, $nrOfDays){

        //products associated to this account
        $productsIDs = DB::table('products')
                          ->select('id', 'name')
                          ->where('designer_id', '=', $designerID)
                          ->get()->pluck('id')->toArray();

        //get the last 7 days as a collection of objects
        $range = self::getRangeDays($nrOfDays);

        //map the collection and get the sales for that day
        $range->map(function($day) use ($productsIDs){
            $day->sales  = self::nrSalesPerDay($day->day, $productsIDs);
            $day->format = self::formatDay($day->day, 'M', 'd');
        });

        //pluck and build two arrays, to use it with the graph
        $daysList  = $range->pluck('format');
        $salesList = $range->pluck('sales');

        $response = array(
            'days'  => $daysList,
            'sales' => $salesList,
            'success' => true,
            'type' => 'dayFilter',
        );

        return $response;
    }

    static function calculatePercentageChange($oldValue, $newValue) {
        if($newValue == 0 || $oldValue==0){
            return 0;
        }
        $percentageChange = (($newValue - $oldValue) / abs($oldValue)) * 100;
        return $percentageChange;
    }

    static function getNrOfHitsInRange($range, $productsIDs){
        $start = $range->last()->day;
        $end   = $range->first()->day;

        $totalHits = DB::table('products_hits')
                        ->selectRaw('COUNT(product_id) as totalHits')
                        ->whereBetween(DB::raw('DATE(created_at)'), [$start, $end])
                        ->whereIn('product_id', $productsIDs)
                        ->get()->first();

        $total = (isset($totalHits->totalHits) && $totalHits->totalHits > 0) ? $totalHits->totalHits : 0;

        return (int)$total;

    }
    static function getRapportsByDays($designerID, $nrOfDays){
        $productsIDs = DB::table('products')
                          ->select('id', 'name')
                          ->where('designer_id', '=', $designerID)
                          ->get()->pluck('id')->toArray();
        if(!empty($productsIDs)){
            $range        = self::getRangeDays($nrOfDays);
            $rangeCompare = self::getRangeDaysOffset($nrOfDays);

            $hitsRange1 = self::getNrOfHitsInRange($range, $productsIDs);
            $hitsRange2 = self::getNrOfHitsInRange($rangeCompare, $productsIDs);

            $percentageDifference = self::calculatePercentageChange($hitsRange2, $hitsRange1);
            $type = ($percentageDifference < 0) ? 'red' : 'green';
            $response = array(
                'percentageDifference' => number_format($percentageDifference, 2),
                'hitsInCurrentRange'   => $hitsRange1,
                'hitsInPreviousRange'  => $hitsRange2,
                'type'                 => $type
            );
        }else{
            $response = array(
                'percentageDifference' => 0,
                'hitsInCurrentRange'   => 0,
                'hitsInPreviousRange'  => 0,
                'type'                 => 'percent'
            );
        }

        return $response;

    }

    static function getTotalToInvoice($designerID){
        $totalInvoices = DB::table('reseller_invoices')
                            ->selectRaw('SUM(amount_to_invoice) as total')
                            ->where('designer_id', $designerID)
                            ->get()
                            ->first();
        $totalInvoices = (isset($totalInvoices->total) && $totalInvoices->total > 0) ? $totalInvoices->total : 0;

        return $totalInvoices;
    }

    static function getTotalToInvoiceCurrentMonth($designerID){
        $totalThisMonth = DB::table('reseller_invoices')
                            ->selectRaw('SUM(amount_to_invoice) as total')
                            ->where('designer_id', $designerID)
                            ->where('month', now()->month)
                            ->where('year', now()->year)
                            ->get()
                            ->first();
        $totalThisMonth = (isset($totalThisMonth->total) && $totalThisMonth->total > 0) ? $totalThisMonth->total : 0;

        return $totalThisMonth;
    }


    static function getInvoicesRapport($designerID, $nrOfDays){
        $invoiceTotal     = self::getTotalToInvoice($designerID);
        $invoiceThisMonth = self::getTotalToInvoiceCurrentMonth($designerID);
        $percentageDifference = self::calculatePercentageChange($invoiceTotal, $invoiceThisMonth);

        $type = ($percentageDifference < 0) ? 'red' : 'green';
        $response = array(
            'percentageDifference' => number_format($percentageDifference, 2),
            'invoiceTotal'         => $invoiceTotal,
            'invoiceThisMonth'     => $invoiceThisMonth,
            'type'                 => $type
        );
        return $response;
    }



    static function checkIFInvoiceRecordExists($month, $year, $accountID){
        $currentRecord = DB::table('reseller_invoices')
                            ->select('id', 'subtotal_sales', 'amount_to_invoice', 'designer_id', 'invoice_status', 'invoice', 'nr_of_notice_sent', 'month', 'year', 'created_at')
                            ->where('month', $month)
                            ->where('year', $year)
                            ->where('designer_id', '=', $accountID)
                            ->get()->first();

        $invoiceData = array(
            'exists'      => isset($currentRecord->id) ? true : false,
            'invoiceData' => $currentRecord
        );

        return $invoiceData;

    }


    static function calculateAmountToInvoice($subtotalForCurrentMonth){
        $shopFee = DB::table('shop_settings')->select('shop_fee', 'shop_fee_type')->where('id', 1)->first();
        $amountToInvoice = extractResellerPrice($subtotalForCurrentMonth, $shopFee->shop_fee, $shopFee->shop_fee_type );

        return $amountToInvoice;
    }

    static function registerResellerInvoice(){
        $accountID = AccountModel::getAccountID();
        $tva = DB::table('shop_settings')->select('tva', 'tax_type')->where('id', 1)->first();

        $subtotalForCurrentMonth = DB::table('orders_items')
                                    ->selectRaw('SUM(subtotal) as total')
                                    ->whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->where('designer_id', '=', $accountID)
                                    ->get()
                                    ->first();

        $subtotalForCurrentMonth = (double)$subtotalForCurrentMonth->total;
        $amountToInvoice         = self::calculateAmountToInvoice($subtotalForCurrentMonth);
        $calculatedTVA           = CartModel::extractTVA($amountToInvoice, $tva->tva, $tva->tax_type);
        $amountToInvoiceWithTVA  = $amountToInvoice + $calculatedTVA;

        $recordExists = self::checkIFInvoiceRecordExists(now()->month, now()->year, $accountID);

        if($recordExists['exists']){
            $resellerInvoices = array(
                'designer_id'          => $accountID,
                'subtotal_sales'       => $subtotalForCurrentMonth,
                'amount_to_invoice'    => $amountToInvoice,
                'amount_shown_to_shop' => $amountToInvoiceWithTVA,
                'invoice_status'       => $recordExists['invoiceData']->invoice_status,
                'invoice'              => $recordExists['invoiceData']->invoice,
                'nr_of_notice_sent'    => $recordExists['invoiceData']->nr_of_notice_sent,
                'month'                => $recordExists['invoiceData']->month,
                'year'                 => $recordExists['invoiceData']->year,
                'created_at'           => $recordExists['invoiceData']->created_at,
                'updated_at'           => Carbon::now()->format('Y-m-d H:i:s')
            );

        }else{
            $resellerInvoices = array(
                'designer_id'          => $accountID,
                'subtotal_sales'       => $subtotalForCurrentMonth,
                'amount_to_invoice'    => $amountToInvoice,
                'amount_shown_to_shop' => $amountToInvoiceWithTVA,
                'invoice_status'       => 'notUploaded',
                'invoice'              => null,
                'nr_of_notice_sent'    => 0,
                'month'                => now()->month,
                'year'                 => now()->year,
                'created_at'           => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'           => Carbon::now()->format('Y-m-d H:i:s')
            );
        }


        DB::table('reseller_invoices')->updateOrInsert(
                ['designer_id'=>$accountID, 'month'=>now()->month, 'year'=>now()->year],
                $resellerInvoices
        );
    }

    static function returnPaymentstatus($orderID){
        $payStatus = DB::table('transactions')
                         ->select('status')
                         ->where('order_id', $orderID)
                         ->get()
                         ->last();

        return (isset($payStatus->status) && !empty($payStatus->status)) ? $payStatus->status : '';
    }

    static function checkIFRelatedInvoicesArePaid($accountID){
        $orderIds = DB::table('orders_items')
                        ->select('order_id')
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->where('designer_id', '=', $accountID)
                        ->get();

        if(count($orderIds) > 0){
            $orderIds->map(function($order){
                $order->status = self::returnPaymentstatus($order->order_id);
            });
            $allPaymentConfirmed = $orderIds->every(function ($item) {
                return $item->status === 'paymentConfirmed' || $item->status === 'paymentFirstHalfConfirmed' || $item->status === 'paymentCollected';
            });
        }else{
            $allPaymentConfirmed = false;
        }

        return $allPaymentConfirmed;
    }

    static function invoiceGateInfos($accountID){

        $lastDayofMonth    = checkIfIsLastDayOfMonth();
        $invoicesArePaid   = self::checkIFRelatedInvoicesArePaid($accountID);
        $recordExists      = self::checkIFInvoiceRecordExists(now()->month, now()->year, $accountID);

        $infos = array(
            'lastDayofMonth'  => $lastDayofMonth,
            'invoicesArePaid' => $invoicesArePaid,
            'recordExists'    => $recordExists['exists'],
            'invoiceData'     => ($recordExists['exists']) ? $recordExists['invoiceData'] : array()
        );

        return $infos;
    }


    static function getInvoiceForMonth($month, $year, $accountID){
        $invoice = DB::table('reseller_invoices')
            ->select('*')
            ->where('designer_id', $accountID)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if(isset($invoice->invoice_status)){
            $invoice->invoice_status = mapStatus($invoice->invoice_status);
            $month = Carbon::create()->day(1)->month($month);
            $invoice->month = $month->format('M');
            $invoice->lastDayofMonth = checkIfIsLastDayOfMonth();
            $invoice->sameMonth = checkIfCurrentMonthIsSame($invoice->month);
            $invoice->invoicesArePaid = self::checkIFRelatedInvoicesArePaid($accountID);
        }else{
            $month = Carbon::create()->day(1)->month($month);
            $obj = new \stdClass();
            $obj->month = $month->format('M');
            return $obj;
        }

        return $invoice;
    }

    static function getInvoicesByYearMonth($accountID){

        $years = DB::table('reseller_invoices')->select('year')->groupBy('year')->orderBy('year', 'DESC')->get();
        if($years->isEmpty()){
            $yearObject = new \stdClass();
            $yearObject->year = now()->year;
            $years->put(0, $yearObject);
        }

        $years->map(function($year) use($accountID){
            $year->months = collect(range(1,12))->map(function($month) use ($year, $accountID){
                return self::getInvoiceForMonth($month, $year->year, $accountID);
            });
        });
        //dd($years);
        return $years;
    }
}
