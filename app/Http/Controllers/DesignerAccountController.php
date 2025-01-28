<?php

namespace App\Http\Controllers;

use App\Models\DesignerAccount;
use App\Models\Account as AccountModel;
use App\Models\Cart as CartModel;
use Illuminate\Http\Request;
use Exception;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Locomotif\Media\Models\Media;
//use Locomotif\Admin\Models\Users;
use Locomotif\Designers\Models\Designer;
use Locomotif\Designers\Models\DesignersAddresses;
use Locomotif\Designers\Models\AccountCompany;
use Locomotif\Products\Models\ProductsAttributes;
use Locomotif\Products\Models\ProductsCategories;
use Locomotif\Products\Models\ProductsArea;
use Locomotif\Products\Models\Products;
use Locomotif\Products\Models\ProductsMeta;
use Locomotif\Products\Models\ProductsSubcategories;




class DesignerAccountController extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function dashboard(){

        $accountID       = AccountModel::getAccountID();
        $userRole        = AccountModel::getUserRole();
        $profilePicture  = AccountModel::getProfilePicture($accountID, 'accounts');
        $products        = DesignerAccount::getMostPopularProductsByDesigner($accountID);
        $salesRapport    = DesignerAccount::getRapportsByDays($accountID, 6);
        $invoicesRapport = DesignerAccount::getInvoicesRapport($accountID, 31);
                           DesignerAccount::registerResellerInvoice();

        return view('accounts.designers.account.dashboard')
                ->with(compact('accountID'))
                ->with(compact('userRole'))
                ->with(compact('profilePicture'))
                ->with(compact('products'))
                ->with(compact('salesRapport'))
                ->with(compact('invoicesRapport'));
    }

    public function raports(){

        $accountID        = AccountModel::getAccountID();
        $userRole         = AccountModel::getUserRole();
        $profilePicture   = AccountModel::getProfilePicture($accountID, 'accounts');
        $salesRapport     = DesignerAccount::getRapportsByDays($accountID, 6);
        $invoicesRapport  = DesignerAccount::getInvoicesRapport($accountID, 31);
        $invoiceGateInfos = DesignerAccount::invoiceGateInfos($accountID);

        return view('accounts.designers.account.raports')
                ->with(compact('accountID'))
                ->with(compact('userRole'))
                ->with(compact('profilePicture'))
                ->with(compact('salesRapport'))
                ->with(compact('invoicesRapport'))
                ->with(compact('invoiceGateInfos'));
    }

    public function administrative(){

        $accountID        = AccountModel::getAccountID();
        $userRole         = AccountModel::getUserRole();
        $profilePicture   = AccountModel::getProfilePicture($accountID, 'accounts');
        $companyInfos     = AccountModel::getCompanyInfos($accountID);
        $invoicesList     = DesignerAccount::getInvoicesByYearMonth($accountID);
        //$invoiceGateInfos = DesignerAccount::invoiceGateInfos($accountID);
        //dd($invoicesList);

        return view('accounts.designers.account.administrative')
                ->with(compact('accountID'))
                ->with(compact('userRole'))
                ->with(compact('profilePicture'))
                ->with(compact('companyInfos'))
                ->with(compact('invoicesList'));
    }

    public function myProducts(){

        $accountID      = AccountModel::getAccountID();
        $userRole       = AccountModel::getUserRole();
        $accountID      = AccountModel::getAccountID();
        $profilePicture = AccountModel::getProfilePicture($accountID, 'accounts');
        $products       = DesignerAccount::getDesignerProducts($accountID, 4);

        return view('accounts.designers.account.myProducts')
            ->with('products', $products)
            ->with(compact('accountID'))
            ->with(compact('userRole'))
            ->with(compact('profilePicture'));
    }


    public function rebuildComponents($components){
        foreach ($components as $key => $item) {
            $metaKey = $item['meta_key'];

            if (!isset($result[$metaKey])) {
                $result[$metaKey] = [
                    'meta_name' => $item['meta_name'],
                    'meta_owner' => $item['meta_owner'],
                    'meta_key' => $metaKey,
                    'meta_attributes' => []
                ];
            }

            $result[$metaKey]['meta_attributes'][$item['meta_attribute']] = $item['meta_value'];
        }
        return $result;
    }


    public function insertCategoryToProduct($subcategories, $pid){
        DB::table('products_to_categories')->where([
            ['product_id',  '=', $pid]
        ])->delete();
        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($subcategories as $key => $subcategory) {
            $subcateg = ProductsSubcategories::with('category')->where('id', $subcategory)->first();
            $categs[] = $subcateg['category'];
        }

        $uniqueCategories = collect($categs)->pluck('id')->unique()->values();
        foreach ($uniqueCategories as $kk => $uniqueCatId) {
            $isMain = ($kk==0) ? 1 : 0;
            DB::table('products_to_categories')->insert([
                'product_id'  => $pid,
                'category_id' => $uniqueCatId,
                'main'        => $isMain,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }


    }
    public function insertSubcategoriesToProduct($subcategories, $pid){
        DB::table('products_to_subcategories')->where([
            ['product_id',  '=', $pid]
        ])->delete();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($subcategories as $key => $subcategID) {
            $isMain = ($key==0) ? 1 : 0;
            DB::table('products_to_subcategories')->insert([
                'product_id'     => $pid,
                'subcategory_id' => $subcategID,
                'main'           => $isMain,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
        }

    }

    public function insertAreaToProduct($areas, $pid){
        DB::table('products_to_areas')->where([
            ['product_id',  '=', $pid]
        ])->delete();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($areas as $key => $area) {
            DB::table('products_to_areas')->insert([
                'product_id'  => $pid,
                'area_id'     => $area,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    }

    public function addProduct(){
        $accountID = AccountModel::getAccountID();
        $userRole = AccountModel::getUserRole();
        $profilePicture = AccountModel::getProfilePicture($accountID, 'accounts');
        $productsAttributes = ProductsAttributes::all();
        $productCategories = ProductsCategories::with('subcategories')->get();
        $productsAreas = ProductsArea::all();

        // Session::forget('productMeta');
        $components = request()->session()->get('productMeta');
        $components = ($components != null) ? $this->rebuildComponents($components) : 0;


        return view('accounts.designers.account.addProduct')
                ->with('productsAttributes', $productsAttributes)
                ->with('components', $components)
                ->with('productCategories', $productCategories)
                ->with('productsAreas', $productsAreas)
                ->with(compact('accountID'))
                ->with(compact('userRole'))
                ->with(compact('profilePicture'));
    }




    public function getAssocValues(Request $request){
        $data = $request->json()->all();
        $attr_values = DesignerAccount::getAssocValues($data['attr_id']);
        return response()->json($attr_values);
    }
    public function getGroupedAssocValues(Request $request){
        $data = $request->json()->all();
        $attr_values = DesignerAccount::getGroupedAssocValues($data['attr_identifier']);
        return response()->json($attr_values);
    }

    public function arraysMatch($array1, $array2){
        $keysToIgnore = ['meta_value'];

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
    public function putComponentToSession(Request $request){
        $component = $request->json()->all();

        $productMeta = Session::get('productMeta', []);


        $exists = false;
        foreach ($productMeta as $item) {
            if ($this->arraysMatch($item, $component)) {
                $exists = true;
                break;
            }
        }

        if($exists==true){
            $response = [
                'success' => false,
                'type'    => 'putComponentToSession',
                'message' => array('Această proprietate este deja asociată acestui produs.'),
                'returnedResponse' => $component
            ];
        }else{
            $productMeta[] = $component;
            Session::put('productMeta', $productMeta);
            $response = [
                'success' => true,
                'type'    => 'putComponentToSession',
                'message' => array('Proprietate adăugată.'),
                'returnedResponse' => $component
            ];
        }


        //Session::forget('productMeta');

        return response()->json($response);
    }

    public function deleteAllComponentsFromSession(){
        Session::forget('productMeta');
        $response = [
            'success' => true,
            'type'    => 'deleteAllComponentsFromSession',
            'message' => array('Toate componentele au fost șterse.'),
        ];
        return response()->json($response);
    }

    public function saveProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'subcategories'         => 'required',
            'areas'                 => 'required',
            'description'           => 'required',
            'gdpr'                  => 'accepted',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }else{
            $accountID = AccountModel::getAccountID();

            $url = $this->preventSameUrlSubmit($request->url);

            $product = new Products();

            $product->name              = $request->name;
            $product->url               = $url;
            $product->designer_id        = $accountID;
            $product->product_type      = 'designer';
            $product->sku               = 'SKU'.getOrdering('products', 'ordering');
            $product->stock             = 0;
            $product->price             = 0;
            $product->price_estimate    = 0;
            $product->description       = $request->description;
            $product->ordering          = getOrdering('products', 'ordering');
            $product->ordering_designer = getOrderingFiltered('products', 'designer_id', $accountID, 'ordering_designer');
            $product->rand_3d           = 0;
            $product->favourite_product = 0;
            $product->product_status    = 'pending';

            $product->save();

            $pid = $product->id;

            //get and save categories and subcategories
            if(!empty($request->subcategories) && count($request->subcategories) !=0){
                $this->insertSubcategoriesToProduct($request->subcategories, $pid);
                $this->insertCategoryToProduct($request->subcategories, $pid);
            }

            //get and save areas
            if(!empty($request->areas) && count($request->areas) !=0){
                $this->insertAreaToProduct($request->areas, $pid);
            }

            //get and save product component
            $components = request()->session()->get('productMeta');
            $components = ($components != null) ? $components : null;


            if($components != null){
                foreach ($components as $key => $component) {

                    $productMeta = new ProductsMeta();
                    $productMeta->pid               = $pid;
                    $productMeta->meta_name         = $component['meta_name'];
                    $productMeta->meta_owner        = $component['meta_owner'];
                    $productMeta->meta_key          = $component['meta_key'];
                    $productMeta->meta_attribute    = $component['meta_attribute'];
                    $productMeta->meta_combined_key = $component['meta_combined_key'];
                    $productMeta->meta_value        = $component['meta_value'];
                    $productMeta->save();
                }
            }else{
                $response = [
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('Adaugă componente pentru produs.'),
                ];
                return response()->json($response);
            }

            //get and save product images
            if(isset($request->images) && !empty($request->images)){
                foreach ($request->images as $key => $value) {
                    $ordering = $key + 1;
                    $isMain = ($ordering==1) ? 1 : 0;
                    $mediaElement = new Media();
                    $mediaElement->original_name  = $value->getClientOriginalName();
                    $mediaElement->file           = $value->hashName();
                    $mediaElement->owner          = 'products';
                    $mediaElement->owner_id       = $pid;
                    $mediaElement->main           = $isMain;
                    $mediaElement->folder         = 'media';
                    $mediaElement->type           = $value->extension();
                    $mediaElement->ordering       = getOrdering('media', 'ordering');
                    $mediaElement->ordering_owner = $ordering;
                    $mediaElement->status         = 'published';

                    $mediaElement->save();
                    $value->store('media');
                }
            }else{
                $response = [
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('Adaugă cel puțin o imagine pentru produs.'),
                ];
                return response()->json($response);
            }


            $response = [
                'success' => true,
                'type'    => 'productAdded',
                'resetForm' => true,
                'message' => array('Produsul a fost adăugat. Vei primi un e-mail după confirmarea datelor furnizate.'),
            ];
        }




        return response()->json($response);

    }
    public function preventSameUrlSubmit($url, $maxAttempts = 100){

        if(!empty($url)){
            $urlNr = DB::table('products')->where('url', $url)->select('*', DB::raw('COUNT(*) as total'))->get();
            $nr = $urlNr->first()->total;
            if($nr > 0){
                $urlString = (string)$nr;
                $url = $url.'-'.$urlString;
                if ($maxAttempts > 0) {
                    $url = $this->preventSameUrlSubmit($url, $maxAttempts - 1);
                }

            }else{
                $url = $url;
            }
        }else{
            $url = Str::random(30);
        }


        return $url;

    }


    public function getInitialDesignerSalesNrByDay(Request $request){
        $accountID      = AccountModel::getAccountID();
        $days = $request->json()->all();
        $productSales = (isset($days['nrOfDays']) && $days['nrOfDays'] <= 0) ? array('success'=>false) : DesignerAccount::getInitialDesignerSalesNrByDay($accountID, $days['nrOfDays']);

        return response()->json($productSales);
    }


    public function uploadInvoice(Request $request){

        $messages = [
            'invoice.required' => 'Trebuie să încarci o factură.',
            'invoice.file'     => 'Trebuie să încarci o factură.',
            'invoice.max'      => 'Fișierul nu poate fi mai mare de 2MB.',
            'invoice.mimes'    => 'Fișierul trebuie să fie în format PDF.',
        ];

        $validator = Validator::make($request->all(), [
            'invoice' => 'required|file|max:2048|mimes:pdf', // Adjust max size and allowed mime types
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }

        $invoice = $request->file('invoice');
        $invoiceName = $invoice->hashName();
        $invoice->store('invoices');
        $resellerInvoiceID = $request->input('reseller_invoices_id');
        $accountID         = $request->input('accountID');

        DB::table('reseller_invoices')
            ->where('id', $resellerInvoiceID)
            ->update([
                    'invoice'        => $invoiceName,
                    'invoice_status' => 'uploaded'
                ]);

        //CartModel::sendShopInvoiceNotification($accountID);

        $response = array(
            'success'     => true,
            'invoiceName' => $invoiceName,
            'message'     => 'Factura a fost înregistrată cu succes.'
        );
        return response()->json($response);
    }
}
