<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralPages;
use App\Http\Controllers\Products;
use App\Http\Controllers\Cart;
use App\Http\Controllers\DesignersController;
use App\Http\Controllers\ClientAccountController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DesignerAccountController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\Account;
use App\Http\Controllers\AjaxUtilsController;
use App\Http\Middleware\AccountsGate;
use App\Http\Middleware\AccountRedirect;
use App\Http\Middleware\AccountCheckAuth;
use App\Http\Controllers\LeadsController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* !! IMPORTANT
 * De pus url-urile cu schema simpla, ex: domeniu/cos-de-cumparaturi.html inainte de route-urile de produs
 */

Route::controller(LeadsController::class)->group(function(){
    Route::post('/savelead', 'saveLead')->name('saveLead');
});

Route::controller(AjaxUtilsController::class)->group(function(){
    Route::POST('/getCityByCounty', 'getCityByCounty');
    Route::POST('/savenewsletter', 'saveNewsletter')->name('saveNewsletter');
});

Route::controller(GeneralPages::class)->group(function(){
    Route::get('/',                       'homepage');
    Route::get('/contact.html',           'contact')->name('contact');
    Route::get('/despre-noi.html',        'aboutUs');
    Route::get('/faq.html',               'faq')->name('faq');
    Route::get('/politica-cookies.html','cookiesPolicy')->name('cookies.policy');
    Route::get('/politica-gdpr.html','gdprPolicy')->name('gdpr.policy');
    Route::get('/termeni-si-consitii.html','termsAndConditions')->name('terms.and.conditions');
    Route::get('/brandul-masara.html','masaraBrand')->name('masara.brand');
});

Route::controller(Cart::class)->group(function(){
    Route::get('/cos/produse.html',         'cartPage');
    Route::get('/cos/detalii-comanda.html', 'orderDetails');
    Route::get('/cos/checkout.html',        'orderSummary');
    Route::get('/cos/comanda-plasata.html', 'orderSuccess');

    Route::POST('/addProductToCartSession',       'addProductToCartSession');
    Route::POST('/updateProductToCartSession',    'updateProductToCartSession');
    Route::POST('/deleteProductToCartSession',    'deleteProductToCartSession');
    Route::GET('/recalculateCartSession',         'recalculateCartSession');
    Route::POST('/cart/putOrderDetailsToSession', 'putOrderDetailsToSession');
    Route::POST('/cart/buildAndPlaceOrder',       'buildAndPlaceOrder');
    Route::POST('/cart/initializeMoneyOrder',     'initializeMoneyOrder');
    Route::GET('/cart/generateInvoice',           'testInvoices');

});

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('/stripeTest',      'stripeTest');
    Route::post('/stripePostTest', 'stripePostTest');

    Route::get('/createCustomer',        'createCustomer');
    Route::get('/createExpressAccount',  'createExpressAccount');

    Route::get('/createCheckoutSession', 'createCheckoutSession');
    Route::POST('/cardSaveSuccess',      'cardSaveSuccess');

    //route pentru checkout
    Route::POST('/stripe/createPaymentIntent', 'createPaymentIntent');
    Route::POST('/stripe/updatePayment',       'updatePayment');
    Route::POST('/stripe/registerAPIResponse', 'registerAPIResponse');


    //route conturi designer
    Route::POST('/createAndSetupExpressAccount', 'createAndSetupExpressAccount');
    Route::get('/deleteExpressAccount',          'deleteExpressAccount');
    Route::POST('/stripe/expressAccountWebhook',  'expressAccountWebhook');
});

Route::controller(BlogController::class)->group(function(){
    Route::get('/blog.html',                   'list');
    Route::get('/blog/{category}',             'category');
    Route::get('/blog/{category}/{blog}.html', 'detail');
});


Route::middleware([AccountsGate::class.':client'])->group(function () {
    Route::controller(ClientAccountController::class)->group(function(){
        Route::get('/cont-client/dashboard.html',       'dashboard');
        Route::get('/cont-client/comenzi.html',         'orders');
        Route::get('/cont-client/favorite.html',        'favourites');
        Route::get('/cont-client/editare-cont.html',    'edit');
    });
});

Route::middleware([AccountsGate::class.':designer'])->group(function () {
    Route::controller(DesignerAccountController::class)->group(function(){
        Route::get('/cont-designer/dashboard.html',          'dashboard');
        Route::get('/cont-designer/rapoarte.html',           'raports');
        Route::get('/cont-designer/administrativ.html',      'administrative');
        Route::get('/cont-designer/produsele-mele.html',     'myProducts');
        Route::get('/cont-designer/adauga-produs.html',      'addProduct');


        Route::POST('/getAssocValues',                       'getAssocValues');
        Route::POST('/getGroupedAssocValues',                'getGroupedAssocValues');
        Route::POST('/putComponentToSession',                'putComponentToSession');
        Route::POST('/deleteAllComponentsFromSession',       'deleteAllComponentsFromSession');
        Route::POST('/checkComponentExists',                 'checkComponentExists');
        Route::POST('/saveProduct',                          'saveProduct');
        Route::POST('/uploadProductImages',                  'storeProductImages');
        Route::POST('/getInitialDesignerSalesNrByDay',       'getInitialDesignerSalesNrByDay');
        Route::POST('/uploadInvoice',                        'uploadInvoice');

    });
});


Route::controller(DesignersController::class)->group(function(){
    Route::get('/designeri.html',                        'designers')->name('designers.list');
    Route::get('/produse-designeri.html',                'designers_products_list');
    Route::get('/designeri/{designer}.html',          'designers_detail');
});





Route::controller(Account::class)->group(function(){
    Route::get('/login.html',                        'loginPage')->middleware([AccountRedirect::class]);
    Route::get('/login/creeaza-cont-designer.html',  'createDesignerAccountPage')->middleware([AccountRedirect::class]);
    Route::get('/login/creeaza-cont-client.html',    'createClientAccountPage')->middleware([AccountRedirect::class]);
    Route::POST('/login/creeaza-cont-designer.html', 'createAccount');
    Route::POST('/login/creeaza-cont-client.html',   'createAccount');

    Route::POST('/uploadProfileImage',               'uploadProfileImage')->middleware([AccountCheckAuth::class]);
    Route::POST('/getProfilePictureAjax',            'getProfilePictureAjax')->middleware([AccountCheckAuth::class]);
    Route::POST('/saveCompanyInfo',                  'saveCompanyInfo')->middleware([AccountCheckAuth::class]);
    Route::POST('/editCompanyInfo',                  'editCompanyInfo')->middleware([AccountCheckAuth::class]);
    Route::POST('/deleteAccountAddress',             'deleteAccountAddress')->middleware([AccountCheckAuth::class]);
    Route::POST('/getAccountAddress',                'getAccountAddress')->middleware([AccountCheckAuth::class]);

    Route::get('/cont-designer/editare-cont.html',    'editAccount')->middleware([AccountsGate::class.':designer']);
    Route::POST('/cont-designer/editare-cont.html',   'updateAccount')->middleware([AccountsGate::class.':designer']);
    Route::POST('/cont-designer/adauga-adresa.html',  'addAddress')->middleware([AccountsGate::class.':designer']);
    Route::POST('/cont-designer/modifica-adresa.html','editAddress')->middleware([AccountsGate::class.':designer']);

    Route::get('/designer/logout.html',               'logout');
    Route::POST('/designer/login.html',               'login');
    Route::get('/client/logout.html',                 'logout');
    Route::POST('/client/login.html',                 'login');

});

Route::controller(Products::class)->group(function(){
    Route::get('/produse.html',                                    'shop')->name('shop');
    Route::get('/produse/{category}',                              'category')->name('category.list');
    Route::get('/produse/{category}/{subcategory}',                'subcategory')->name('subcategory.list');
    Route::get('/produse/{category}/{subcategory}/{frontProduct}.html', 'product')->name('product.detail');
    Route::POST('/getFilteredProducts',                            'getFilteredProducts');
    Route::POST('/clearProductFilters',                            'clearProductFilters');


});




?>
