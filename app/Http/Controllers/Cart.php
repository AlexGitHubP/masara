<?php

namespace App\Http\Controllers;

use App\Models\Cart as CartModel;
use App\Models\GeneralModel;
use App\Models\Account as AccountModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class Cart extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }

    function cartPage(Request $request){
        $cartFunnel = true;

        // Session::forget('cartProduct');
        // Session::forget('orderDetails');
        // Session::forget('orderPaymentAndCarrierToSession');
        // Session::forget('moneyOrderDetails');
        // Session::forget('accountID');

        // echo '<pre>';print_r($request->session()->all());exit;

        return view('cart.cartPage')
            ->with(compact('cartFunnel'));
    }

    function orderDetails(){
        $cartFunnel = true;
        $judete     = GeneralModel::getDistinctCounty();
        $carriers   = CartModel::getActiveCarriers();
        $payMethods = CartModel::getTransactionProviders();
        $cartInfos  = CartModel::getCart();

        if(!isset($cartInfos['cartItems']) || count($cartInfos['cartItems']) <= 0){
            return redirect()->to('/cos/produse.html');
        }

        return view('cart.orderDetails')
            ->with(compact('cartFunnel'))
            ->with(compact('judete'))
            ->with(compact('carriers'))
            ->with(compact('payMethods'));
    }

    function orderSummary(){
        $cartFunnel = true;
        $orderDetails           = CartModel::getOrderDetails();
        $orderPaymentAndCarrier = CartModel::getOrderPaymentAndCarrierFromSession();
        $cartItems              = CartModel::getCart();
        $payBtnCopy = (isset($orderPaymentAndCarrier['paymethod_id']) && $orderPaymentAndCarrier['paymethod_id'] !=1) ? 'Plasează comanda' : 'Plătește';

        if(count($orderDetails) <= 0){
            return redirect()->to('/cos/detalii-comanda.html');
        }
        return view('cart.orderSummary')
            ->with(compact('cartFunnel'))
            ->with(compact('orderDetails'))
            ->with(compact('orderPaymentAndCarrier'))
            ->with(compact('cartItems'))
            ->with(compact('payBtnCopy'));
    }

    function orderSuccess(){
        $cartFunnel = true;
        $orderDetails = Session::get('orderDetails');
        if($orderDetails === null){
            return redirect()->to('/cos/detalii-comanda.html');
        }
        $moneyOrderDetails = Session::get('moneyOrderDetails', []);

        Session::forget('cartProduct');
        Session::forget('orderDetails');
        Session::forget('orderPaymentAndCarrierToSession');
        Session::forget('accountID');


        return view('cart.orderSuccess')
            ->with(compact('cartFunnel'))
            ->with(compact('moneyOrderDetails'));
    }

    public function addProductToCartSession(Request $request){

        $product = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        $cartProducts = Session::get('cartProduct', []);
        $exists = false;

        foreach ($cartProducts as $key => $item) {
            if (CartModel::arraysMatch($item, $product)) {
                $cartProducts[$key]['amount'] = (int)$cartProducts[$key]['amount'] + (int)$product['amount'];
                $newAmount = $cartProducts[$key]['amount'];
                $exists = true;
                break;
            }
        }

        if($exists==true){
            Session::put('cartProduct', $cartProducts);

            $response = [
                'success' => true,
                'type'    => 'addProductToCart',
                'message' => array('Produsul a fost adăugat în coș.'),
                'returnedResponse' => $product
            ];
        }else{
            $cartProducts[] = $product;
            Session::put('cartProduct', $cartProducts);
            $response = [
                'success' => true,
                'type'    => 'addProductToCart',
                'message' => array('Produsul a fost adăugat în coș.'),
                'returnedResponse' => $product
            ];

        }

        $response['totalCartProducts'] = count($cartProducts);
        $response['resetForm']  = false;
        $response['prodExists'] = $exists;
        $response['newAmount']  = (isset($newAmount) && !empty($newAmount)) ? $newAmount : 0;


        //Session::forget('cartProduct');

        return response()->json($response);
    }
    public function recalculateCartSession(Request $request){
        $cart = request()->session()->get('cartProduct');
        $totalRecalculated = CartModel::calculateTotalForCart($cart);

        return response()->json($totalRecalculated);
    }

    public function deleteProductToCartSession(Request $request){
        $product = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        $cartProducts = Session::get('cartProduct', []);
        $exists = false;

        foreach ($cartProducts as $key => $item) {

            if (CartModel::arraysMatch($item, $product)) {
                if($cartProducts[$key]['id'] == $product['id']){
                    unset($cartProducts[$key]);
                }
                $exists = true;
                break;
            }
        }

        if($exists==true){
            Session::put('cartProduct', $cartProducts);

            $response = [
                'success' => true,
                'type'    => 'deleteProductToCart',
                'message' => array('Produsul `'.$product['name'].'` a fost sters din cos.'),
                'returnedResponse' => $product
            ];
        }
        $response['totalCartProducts'] = count($cartProducts);

        return response()->json($response);
    }

    public function updateProductToCartSession(Request $request){
        $product = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        $cartProducts = Session::get('cartProduct', []);
        $exists = false;

        foreach ($cartProducts as $key => $item) {

            if (CartModel::arraysMatch($item, $product)) {
                $cartProducts[$key]['amount'] = ($product['operation']=='increase') ? (int)$cartProducts[$key]['amount'] + 1 : (int)$cartProducts[$key]['amount'] - 1;

                if($cartProducts[$key]['amount'] <= 0){
                    $cartProducts[$key]['amount'] = 1;
                }

                $product['amount'] = $cartProducts[$key]['amount'];
                $exists = true;
                break;
            }
        }

        if($exists==true){
            Session::put('cartProduct', $cartProducts);

            $response = [
                'success' => true,
                'type'    => 'updateProductToCart',
                'message' => array('Cantitatea produsului a fost modificata.'),
                'returnedResponse' => $product
            ];
        }

        return response()->json($response);

    }

    public function putOrderDetailsToSession(Request $request){
        $originalOrderDetails = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        $orderDetails = CartModel::buildOrderDetails($originalOrderDetails);

        if($orderDetails['success'] == false){
            $sessionResponse = $orderDetails;
        }else{
            $sessionResponse = CartModel::putOrderDetailsToSession($orderDetails['returnedResponse']);
                               CartModel::putOrderPaymentAndCarrierToSession($orderDetails['returnedPaymentDetails']);
        }

        return response()->json($sessionResponse);
    }

    public function buildAndPlaceOrder(Request $request){
        $orderDetails             = CartModel::getOrderDetails();
        $paymentAndCarrierDetails = CartModel::getOrderPaymentAndCarrierFromSession();
        $account                  = AccountModel::createPreorderAccount($orderDetails);
        $cartItems                = CartModel::getCart();
        $order                    = CartModel::createOrder($paymentAndCarrierDetails, $orderDetails, $cartItems, $account);

        return response()->json($order);
    }

    public function initializeMoneyOrder(Request $request){
        $orderDetails = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        $moneyOrderDetails = CartModel::buildMoneyOrder($orderDetails);
        $moneyOrderDetails['success'] = CartModel::putMoneyOrderToSession($moneyOrderDetails);
        return response()->json($moneyOrderDetails);
    }


}
