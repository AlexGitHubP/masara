<?php

namespace App\Http\Controllers;


use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Cart as CartModel;
use App\Models\Account as AccountModel;
use App\Models\StripePayment;

class StripePaymentController extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }

    public function stripeTest(){
        return view('cart.stripeTest');
    }

    public function createCustomer(Request $request){
        $customerInfos = AccountModel::getAccountAddress(AccountModel::getAccountID());
        
        if(empty($customerInfos['addresses']) || count($customerInfos['addresses']) <= 0 ){
            $response['success'] = false;
            $response['message'] = 'Trebuie să adaugi adresă pentru contul tău înainte de a adăuga datele de card. <a href="/cont-designer/editare-cont.html">Adaugă adresa</a>.';
            return response()->json($response);
        }
        $apiResponse = StripePayment::createCustomer($customerInfos);
        
        if($apiResponse['code']==202){
            $apiResponse = StripePayment::setupIntentForCustomer($apiResponse);
        }
        
        $reference   = StripePayment::storeCustomerReference($apiResponse);
        $response['success'] = true;
        $response['reference'] = $reference;
        
        return response()->json($response);
    }
    public function createCheckoutSession(Request $request){
        $checkoutUrl = StripePayment::createCheckoutSession($request);
        return redirect($checkoutUrl);
    }
    public function cardSaveSuccess(Request $request){
        
       StripePayment::getAsyncCheckoutSession($request);
       
    }

    




    //conturi designer actions
    public function deleteExpressAccount(){
        //dd('Del function blocked');
        $response = StripePayment::deleteExpressAccount();
        echo '<pre>';print_r($response);exit;
    }

    public function expressAccountWebhook(Request $request){
        StripePayment::expressAccountWebhook($request);
    }

    public function createAndSetupExpressAccount(Request $request){
        
        $accountID = (int)$request->input('accountID');
        if($accountID<=0){
            dd('Datele furnizate sunt incorecte');
        }
        $account        = AccountModel::find($accountID);
        $expressAccount = StripePayment::createExpressAccount($account->email);
                          StripePayment::updateOrInsertStripeInfos($accountID,
                                array(
                                    'stripeAccountID' => $expressAccount->id,
                                    'type' => 'connect'
                                )
                            );

        $expressConnect = StripePayment::setupExpressAccount($expressAccount);
        return Redirect::away($expressConnect->url);
    }

    //conturi designer actions
















    //checkoutOperations
    public function createPaymentIntent(Request $request){
        $det = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        $cartInfos    = CartModel::getCart();
        $orderDetails = CartModel::getOrderDetails();
        $response     = StripePayment::createPaymentIntent($cartInfos['totalCart']);
                        CartModel::setTransaction($response['payIntentDetails'], $det);
        $response['orderDetails'] = $orderDetails;
        Session::forget('moneyOrderDetails');
        return response()->json($response);
    }

    public function registerAPIResponse(Request $request){
        $orderDetails = CartModel::getOrderDetails();
        $apiResponse = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        StripePayment::storeReponseAsJson($apiResponse);
    }

    public function updatePayment(Request $request){
        $payResponse = ($request->header('Content-Type') == 'text/plain;charset=UTF-8') ? $request->json()->all() : $request->all();
        $transactionDetails     = CartModel::getTransactionByPayId($payResponse);
        $paymentConfirmedExists = CartModel::checkPaymentStatus($transactionDetails, 'paymentConfirmed');
        if($paymentConfirmedExists != true){
            CartModel::updateTransaction($transactionDetails, $payResponse);
        }
        StripePayment::storeReponseAsJson($payResponse);
                              
    }
    //checkoutOperations

    
}
