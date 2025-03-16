<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralPages;
use App\Http\Controllers\Products;
use App\Http\Controllers\Cart;
use App\Http\Controllers\DesignersController;
use App\Http\Controllers\ClientAccountController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\DesignerAccountController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\Account;
use App\Http\Controllers\AjaxUtilsController;
use App\Http\Middleware\AccountsGate;
use App\Http\Middleware\AccountRedirect;
use App\Http\Middleware\AccountCheckAuth;
use App\Http\Controllers\LeadsController;


Route::get('/run-artisan-command', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('optimize');
    \Artisan::call('optimize:clear');
    return 'Cache cleared';
})->middleware('auth'); // Make sure to protect this route


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

Route::get('/shop', function () {
    return redirect('/produse.html');
});
Route::get('/portofoliu', function () {
    return redirect('/portofoliu.html');
});
Route::get('/blog', function () {
    return redirect('/blog.html');
});
Route::get('/despre-noi', function () {
    return redirect('/despre-noi.html');
});
Route::get('/contact-us', function () {
    return redirect('/contact.html');
});
Route::get('/politica-de-retur', function () {
    return redirect('/termeni-si-consitii.html');
});
Route::get('/termeni-si-conditii', function () {
    return redirect('/termeni-si-consitii.html');
});
Route::get('/my-account?action=register', function () {
    return redirect('/login.html');
});


Route::get('/masa-lemn-masiv', function () {
    return redirect('/produse.html');
});
Route::get('/masa-a-ran', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-a-ran-cu-blat-rectangular-180-x-90-x-77-cm.html');
});
Route::get('/blat-round-cut-masa-a-ran', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-a-ran-cu-blat-rectangular-180-x-90-x-77-cm.html');
});
Route::get('/blat-oval', function () {
    return redirect('/produse.html');
});
Route::get('/blat-rectangular-masa-a-ran', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-a-ran-cu-blat-rectangular-180-x-90-x-77-cm.html');
});
Route::get('/freya', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-freya-cu-blat-rectangular-200-x-100-x-4-cm.html');
});
Route::get('/blat-oval-freya', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-freya-cu-blat-rectangular-200-x-100-x-4-cm.html');
});
Route::get('/blat-round-cut-freya', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-freya-cu-blat-rectangular-200-x-100-x-4-cm.html');
});
Route::get('/blat-rectangular-freya', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-freya-cu-blat-rectangular-200-x-100-x-4-cm.html');
});
Route::get('/helios', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar---blat-rectangular---model-helios-240-x-100-x-4-cm.html');
});
Route::get('/blat-round-cut-helios', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar---blat-rectangular---model-helios-240-x-100-x-4-cm.html');
});
Route::get('/blat-oval-helios', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar---blat-rectangular---model-helios-240-x-100-x-4-cm.html');
});
Route::get('/blat-rectangular-helios', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar---blat-rectangular---model-helios-240-x-100-x-4-cm.html');
});
Route::get('/kotys', function () {
    return redirect('/produse/mese/mese-dining/masa-bucatarie-stejar-kotys-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-oval-masa-kotys', function () {
    return redirect('/produse/mese/mese-dining/masa-bucatarie-stejar-kotys-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-round-cut-masa-kotys', function () {
    return redirect('/produse/mese/mese-dining/masa-bucatarie-stejar-kotys-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-rectangular-masa-kotys', function () {
    return redirect('/produse/mese/mese-dining/masa-bucatarie-stejar-kotys-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/masa-osiris', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-osiris-cu-blat-rectangular-220-x-100-x-7-cm.html');
});
Route::get('/blat-round-cut', function () {
    return redirect('/produse.html');
});
Route::get('/blat-oval-masa-osiris', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-osiris-cu-blat-rectangular-220-x-100-x-7-cm.html');
});
Route::get('/blat-rectangular-masa-osiris', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-din-stejar-osiris-cu-blat-rectangular-220-x-100-x-7-cm.html');
});
Route::get('/masa-poseidon', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-poseidon-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-round-cut-masa-poseidon', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-poseidon-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-oval-masa-poseidon', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-poseidon-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-rectangular-masa-poseidon', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-poseidon-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/masa-ull', function () {
    return redirect('/produse.html');
});
Route::get('/blat-round-cut-masa-ull', function () {
    return redirect('/produse.html');
});
Route::get('/blat-oval-masa-ull', function () {
    return redirect('/produse.html');
});
Route::get('/blat-rectangular-masa-ull', function () {
    return redirect('/produse.html');
});
Route::get('/masa-uranus', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-uranus-cu-blat-rectangular-200-x-100-x-77-cm.html');
});
Route::get('/blat-round-cut-masa-uranus', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-uranus-cu-blat-rectangular-200-x-100-x-77-cm.html');
});
Route::get('/blat-oval-masa-uranus', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-uranus-cu-blat-rectangular-200-x-100-x-77-cm.html');
});
Route::get('/blat-rectangular-masa-uranus', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-uranus-cu-blat-rectangular-200-x-100-x-77-cm.html');
});
Route::get('/masa-x-thor', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-x-thor-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-round-cut-masa-x-thor', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-x-thor-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-oval-masa-x-thor', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-x-thor-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-rectangular-masa-x-thor', function () {
    return redirect('/produse/mese/mese-dining/masa-de-bucatarie-stejar-x-thor-cu-blat-rectangular-200-x-90-x-77-cm.html');
});
Route::get('/blat-hexagonal-colectia-divinity', function () {
    return redirect('/produse.html');
});
Route::get('/blat-rotund-colectia-divinity', function () {
    return redirect('/produse.html');
});
Route::get('/mese-cafea', function () {
    return redirect('/produse.html');
});
Route::get('/blat-hexagonal-mese-cafea-2', function () {
    return redirect('/produse.html');
});

//Route::get('/portofoliu/manufaktura-tm-julius-town', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/jacob-grill-house', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/manufaktura-baneasa-2', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/manufaktura-tm-piata-unirii', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/icuori-cluj', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/kintaro-sushi', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/primarie-blaj', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/scari-interioare', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/mese-lemn-masiv', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/kemo-advertising-sibiu', function () {
//    return redirect('/');
//});
//Route::get('/portofoliu/riflaje', function () {
//    return redirect('/');
//});

Route::get('/dimensiunea-potrivita-la-masa', function () {
    return redirect('//blog/sfaturi-utile/dimensiunea-potrivita-pentru-masa.html');
});
Route::get('/glafurile-interioare-din-lemn-masiv-avantaje', function () {
    return redirect('/blog/sfaturi-utile/glafurile-interioare-din-lemn-masiv.html');
});
Route::get('/3-idei-de-design-pentru-scara-din-lemn-masiv', function () {
    return redirect('/blog/sfaturi-utile/3-idei-de-design-pentru-scari-din-lemn.html');
});
Route::get('/ulei-si-lac-care-este-diferenta', function () {
    return redirect('/blog/sfaturi-utile/ulei-sau-lac--care-este-diferena.html');
});
Route::get('/riflajul-interior-un-moft-sau-o-necesitate', function () {
    return redirect('/blog/sfaturi-utile/riflajul-interior-un-moft-sau-o-necesitate.html');
});
Route::get('/de-ce-masa-ta-de-sufragerie-este-atat-de-importanta-pentru-casa-ta', function () {
    return redirect('/blog/sfaturi-utile/de-ce-masa-de-sufragerie-este-importanta-.html');
});
Route::get('/alegerea-scaunelor-de-sufragerie', function () {
    return redirect('/blog/sfaturi-utile/alegerea-scaunelor-de-sufragerie.html');
});
Route::get('/detalii-tehnice', function () {
    return redirect('/blog/sfaturi-utile/dimensiuni-materiale-procedura-de-asamblare-si-intretinere.html');
});
Route::get('/top-5-aspecte-masa-de-lemn-masiv', function () {
    return redirect('/blog/sfaturi-utile/top-5-lucruri-la-care-sa-fii-atent-cand-iti-cumperi-o-masa-de-lemn-masiv.html');
});
Route::get('/masara-un-nou-concept-pe-piata-din-romania', function () {
    return redirect('/blog/despre-noi/masara--un-nou-concept-pe-piata-din-romania.html');
});



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

Route::controller(PortfolioController::class)->group(function(){
    Route::get('/portofoliu.html', 'list')->name('portfolio.list');
    Route::get('/portofoliu/{portofoliu}.html', 'detail');
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
