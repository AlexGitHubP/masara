<?php

namespace App\Models;

use Stripe;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


use Locomotif\Admin\Models\Users;

class StripePayment extends Model{

    static function getStripeCustomerID(){
        $userID = Users::find(Auth::user()->id);
        $userID = (isset($userID->id) && !empty($userID->id)) ? $userID->id : 0;
        $stripeCustomerID = DB::table('stripe_infos')->where('userID', $userID)->latest()->first();
        
        $stripeCustomerID = (isset($stripeCustomerID->stripeCustomerID) && !empty($stripeCustomerID->stripeCustomerID)) ? $stripeCustomerID->stripeCustomerID : '';

        return $stripeCustomerID;
    }
    static function getUserID(){
        
        if(Auth::check()){
            $userID = Users::find(Auth::user()->id);
            $userID = (isset($userID->id) && !empty($userID->id)) ? $userID->id : 0;
        }else{
            $userID = 0;
        }

        return $userID;
    }

    static function createCustomer($customerInfos){
        Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));   
        
        $address = $customerInfos['addresses'][0]->street.', '.$customerInfos['addresses'][0]->nr;
        
        try {
            $customer = Stripe\Customer::create(array(
                "address" => [
                    "line1" => $address,
                    "city" => $customerInfos['addresses'][0]->city,
                    "state" => $customerInfos['addresses'][0]->county,
                    "country" => "RO",
                ],
                "email" => $customerInfos->email,
                "name"  => $customerInfos->name.' '.$customerInfos->surname,
                "phone" => $customerInfos->phone,
            ));

            $response['customerObject'] = $customer;
            $response['uid']  = self::getUserID();
            $response['code'] = 202;
            $response['type'] = 'customerCreate';
            $response['intentID'] = 0;
            $response['customerID'] = (isset($customer->id) && !empty($customer->id)) ? $customer->id : 0;
            $response['customerMessage'] = (isset($customer->id) && !empty($customer->id)) ? 'Client Stripe creeat' : 'Eroare creeare client Stripe';
            //self::setupIntentForCustomer($response);
        }catch(CardException | InvalidRequestException | AuthenticationException | ApiConnectionException | ApiErrorException | RateLimitException $e) {
            $response['customerObject'] = '';
            $response['uid']  = self::getUserID();
            $response['code'] = $e->getHttpStatus();
            $response['type'] = 'customerCreate';
            $response['customerID'] = 0;
            $response['intentID'] = 0;
            $response['customerMessage'] = $e->getMessage();
            
        }catch(Exception $exception){
            $response['customerObject'] = '';
            $response['uid']  = self::getUserID();
            $response['code'] = $exception->getCode();
            $response['type'] = 'customerCreate';
            $response['customerID'] = 0;
            $response['intentID'] = 0;
            $response['customerMessage'] = $exception->getMessage();
        }

        return $response;
        
    }

    static function setupIntentForCustomer($apiResponse){
        
        $stripeCustomerID = $apiResponse['customerObject']->id;
        
        $intent = \Stripe\SetupIntent::create([
                    'payment_method_types' => ['card'],
                    'usage' => 'off_session',
                    'customer' => $apiResponse['customerID'],
                ]);

        $apiResponse['intentID'] = (isset($intent->id) && !empty($intent->id)) ? $intent->id : $apiResponse['intentID'];

        return $apiResponse;
    }

    static function createCheckoutSession($data){
        Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));   
        $customerID = self::getStripeCustomerID();
        $session = \Stripe\Checkout\Session::create([
            'locale' => 'ro',
            'payment_method_types' => ['card'],
            'mode' => 'setup',
            'customer' => $customerID,
            'success_url' => 'http://127.0.0.1:8000/cont-designer/administrativ.html',
            'cancel_url' => 'http://127.0.0.1:8000/cardSaveCancel',
          ]);
        return $session->url;
          
    }

    static function getAsyncCheckoutSession($payload){
        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $paymentIntent = $event->data->object;
                $sClient = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET'));

                $intent = $sClient->setupIntents->retrieve(
                    $paymentIntent->setup_intent,
                    []
                );
                
                $payMethod = $sClient->paymentMethods->attach(
                    $intent->payment_method,
                    ['customer' => $intent->customer]
                  );
                  
                    self::updateCustomerPayDetails($intent->customer, $intent->payment_method);
                  
                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }

    static function getCheckoutSession($sessionId){
        
        $s = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET'));

        $resp = $s->checkout->sessions->retrieve(
            $sessionId,
          []
        );
        
        $intent = $s->setupIntents->retrieve(
            $resp->setup_intent,
            []
        );

        $payMethod = $s->paymentMethods->attach(
            $intent->payment_method,
            ['customer' => $intent->customer]
          );
        
        return $payMethod;
    }

    static function storeCustomerReference($apiResponse){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $jsonResponse = json_encode($apiResponse);
        DB::table('stripe_api_response')->insert([
            'code'            => $apiResponse['code'],
            'type'            => $apiResponse['type'],
            'customerMessage' => $apiResponse['customerMessage'],
            'fullResponse'    => $jsonResponse,
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);
        if($apiResponse['code']==202){
            $response = DB::table('stripe_infos')->insert([
                'userID'           => $apiResponse['uid'],
                'stripeCustomerID' => $apiResponse['customerID'],
                'stripeIntentID'   => $apiResponse['intentID'],
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
            return $response;
        }
        return false;
    }
    
    static function updateCustomerPayDetails($stripeCustomerID, $stripePayID){
        
        DB::table('stripe_infos')
            ->where('stripeCustomerID', '=', $stripeCustomerID)
            ->update(['stripePayID' => $stripePayID]);
    }

    












    //checkoutOperations
    static function createPaymentIntent($paymentDetails){
        Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET')); 
        $orderTotal = round($paymentDetails['totalOrder']);
        //trebuie imultit cu 100. Stripe accepta integer in cea mai mica denominare ca si plata
        $orderTotal = $orderTotal * 100;
        $orderTotal = (int)$orderTotal;
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $orderTotal,
            'currency' => 'ron',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
    
        $output = [
            'clientSecret' => $paymentIntent->client_secret,
            'payIntentDetails' => $paymentIntent,
        ];

        
        
        return $output;
    }

    static function storeReponseAsJson($apiResponse){
        $accountID = request()->session()->get('accountID');
        $code = (isset($apiResponse['code'])) ? $apiResponse['code'] : null;
        $type = (isset($apiResponse['type'])) ? $apiResponse['type'] : null;
        $apiResponse = json_encode($apiResponse);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        DB::table('stripe_api_response')->insert([
            'code'            => $code,
            'user_id'         => (int)$accountID,
            'type'            => $type,
            'fullResponse'    => $apiResponse,
            'customerMessage' => 'N/A',
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);
    }

    //checkoutOperations




    static function updateOrInsertStripeInfos($userID, $stripeInfos){
        DB::table('stripe_infos')->updateOrInsert(
                ['userID'=>$userID],
                $stripeInfos
        );
    }





    //conturi designer actions
    static function createExpressAccount($email){
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET'));
        $account = $stripe->accounts->create([
            'type' => 'express',
            'country' => 'RO',
            'email' => $email, 
        ]);
        return $account;
    }

    static function setupExpressAccount($account){
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET'));
        $expressResponse = $stripe->accountLinks->create([
                            'account' => $account->id,
                            'refresh_url' => 'https://bb08-86-126-172-107.ngrok-free.app/cont-designer/administrativ.html?action=reauth',
                            'return_url' => 'https://bb08-86-126-172-107.ngrok-free.app/cont-designer/administrativ.html?action=authSuccess',
                            'type' => 'account_onboarding',
                        ]);
        return $expressResponse;
    }
    static function deleteExpressAccount(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET'));

        try {
            $deleteResponse = $stripe->accounts->delete(
                'acct_1NUj5qD5mYpDWWsL',
                []
            );
        } catch (Exception $exception) {
            dd($exception);
        }

        return $deleteResponse;
    }


    
    static function expressAccountWebhook($payload){
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET'));

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_jh1euUQ8YSnfUA1AnJ0BET73Zd57o8vn';

        $payload = @file_get_contents('php://input');
        
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        
        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400);
        exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        http_response_code(400);
        exit();
        }
        echo '<pre>';print_r($event->data->object);exit;
        // Handle the event
        switch ($event->type) {
        case 'account.updated':
            $account = $event->data->object;
        case 'account.application.authorized':
            $application = $event->data->object;
        case 'account.application.deauthorized':
            $application = $event->data->object;
        case 'account.external_account.created':
            $externalAccount = $event->data->object;
        case 'account.external_account.deleted':
            $externalAccount = $event->data->object;
        case 'account.external_account.updated':
            $externalAccount = $event->data->object;
        case 'balance.available':
            $balance = $event->data->object;
        case 'cash_balance.funds_available':
            $cashBalance = $event->data->object;
        case 'charge.captured':
            $charge = $event->data->object;
        case 'charge.expired':
            $charge = $event->data->object;
        case 'charge.failed':
            $charge = $event->data->object;
        case 'charge.pending':
            $charge = $event->data->object;
        case 'charge.refunded':
            $charge = $event->data->object;
        case 'charge.succeeded':
            $charge = $event->data->object;
        case 'charge.updated':
            $charge = $event->data->object;
        case 'charge.dispute.closed':
            $dispute = $event->data->object;
        case 'charge.dispute.created':
            $dispute = $event->data->object;
        case 'charge.dispute.funds_reinstated':
            $dispute = $event->data->object;
        case 'charge.dispute.funds_withdrawn':
            $dispute = $event->data->object;
        case 'charge.dispute.updated':
            $dispute = $event->data->object;
        case 'charge.refund.updated':
            $refund = $event->data->object;
        case 'checkout.session.async_payment_failed':
            $session = $event->data->object;
        case 'checkout.session.async_payment_succeeded':
            $session = $event->data->object;
        case 'checkout.session.completed':
            $session = $event->data->object;
        case 'checkout.session.expired':
            $session = $event->data->object;
        case 'customer.created':
            $customer = $event->data->object;
        case 'customer.deleted':
            $customer = $event->data->object;
        case 'customer.updated':
            $customer = $event->data->object;
        case 'customer.discount.created':
            $discount = $event->data->object;
        case 'customer.discount.deleted':
            $discount = $event->data->object;
        case 'customer.discount.updated':
            $discount = $event->data->object;
        case 'customer.source.created':
            $source = $event->data->object;
        case 'customer.source.deleted':
            $source = $event->data->object;
        case 'customer.source.expiring':
            $source = $event->data->object;
        case 'customer.source.updated':
            $source = $event->data->object;
        case 'customer.subscription.created':
            $subscription = $event->data->object;
        case 'customer.subscription.deleted':
            $subscription = $event->data->object;
        case 'customer.subscription.paused':
            $subscription = $event->data->object;
        case 'customer.subscription.pending_update_applied':
            $subscription = $event->data->object;
        case 'customer.subscription.pending_update_expired':
            $subscription = $event->data->object;
        case 'customer.subscription.resumed':
            $subscription = $event->data->object;
        case 'customer.subscription.trial_will_end':
            $subscription = $event->data->object;
        case 'customer.subscription.updated':
            $subscription = $event->data->object;
        case 'customer.tax_id.created':
            $taxId = $event->data->object;
        case 'customer.tax_id.deleted':
            $taxId = $event->data->object;
        case 'customer.tax_id.updated':
            $taxId = $event->data->object;
        case 'customer_cash_balance_transaction.created':
            $customerCashBalanceTransaction = $event->data->object;
        case 'issuing_transaction.created':
            $issuingTransaction = $event->data->object;
        case 'issuing_transaction.updated':
            $issuingTransaction = $event->data->object;
        case 'payment_intent.amount_capturable_updated':
            $paymentIntent = $event->data->object;
        case 'payment_intent.canceled':
            $paymentIntent = $event->data->object;
        case 'payment_intent.created':
            $paymentIntent = $event->data->object;
        case 'payment_intent.partially_funded':
            $paymentIntent = $event->data->object;
        case 'payment_intent.payment_failed':
            $paymentIntent = $event->data->object;
        case 'payment_intent.processing':
            $paymentIntent = $event->data->object;
        case 'payment_intent.requires_action':
            $paymentIntent = $event->data->object;
        case 'payment_intent.succeeded':
            $paymentIntent = $event->data->object;
        case 'payout.canceled':
            $payout = $event->data->object;
        case 'payout.created':
            $payout = $event->data->object;
        case 'payout.failed':
            $payout = $event->data->object;
        case 'payout.paid':
            $payout = $event->data->object;
        case 'payout.reconciliation_completed':
            $payout = $event->data->object;
        case 'payout.updated':
            $payout = $event->data->object;
        case 'person.created':
            $person = $event->data->object;
        case 'person.deleted':
            $person = $event->data->object;
        case 'person.updated':
            $person = $event->data->object;
        case 'price.created':
            $price = $event->data->object;
        case 'price.deleted':
            $price = $event->data->object;
        case 'price.updated':
            $price = $event->data->object;
        case 'product.created':
            $product = $event->data->object;
        case 'product.deleted':
            $product = $event->data->object;
        case 'product.updated':
            $product = $event->data->object;
        case 'setup_intent.canceled':
            $setupIntent = $event->data->object;
        case 'setup_intent.created':
            $setupIntent = $event->data->object;
        case 'setup_intent.requires_action':
            $setupIntent = $event->data->object;
        case 'setup_intent.setup_failed':
            $setupIntent = $event->data->object;
        case 'setup_intent.succeeded':
            $setupIntent = $event->data->object;
        case 'tax.settings.updated':
            $settings = $event->data->object;
        case 'transfer.created':
            $transfer = $event->data->object;
        case 'transfer.reversed':
            $transfer = $event->data->object;
        case 'transfer.updated':
            $transfer = $event->data->object;
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }
    //conturi designer actions
}

