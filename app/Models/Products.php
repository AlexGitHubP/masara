<?php

namespace App\Models;

use App\Models\DesignerAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use Locomotif\Media\Models\Media;
use Locomotif\Media\Controller\MediaController;

use App\Models\Cart;

use Locomotif\Products\Models\ProductsCategories;
use Locomotif\Products\Models\ProductsSubcategories;



class Products extends Model{

    const PRODUCT_TYPE_MASARA = 'masara';
    const PRODUCT_TYPE_DESIGNER = 'designer';

    public $baseUrl = '/produse';

    public function categories(){
        return $this->belongsToMany('Locomotif\Products\Models\ProductsCategories', 'products_to_categories', 'product_id', 'category_id');
    }

    public function mainCategory(){
        return $this->belongsToMany('Locomotif\Products\Models\ProductsCategories', 'products_to_categories', 'product_id', 'category_id')
                ->where('products_to_categories.main', '=', 1);
    }
    public function mainSubcategory(){
        return $this->belongsToMany('Locomotif\Products\Models\ProductsSubcategories', 'products_to_subcategories', 'product_id', 'subcategory_id')
                ->where('products_to_subcategories.main', '=', 1);
    }


    public function subcategories(){
        return $this->belongsToMany('Locomotif\Products\Models\ProductsSubcategories', 'products_to_subcategories', 'product_id', 'subcategory_id');
    }

    public function defaultCategory(){
        return $this->categories()->first();
    }

    public function designer(){
        return $this->belongsTo(DesignerAccount::class, 'designer_id');

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
    static function buildCategoryUrl($category){
        $url = (new self())->baseUrl;
        $url .= (isset($category->category_url) && !empty($category->category_url)) ? '/'.$category->category_url : '/';
        return $url;
    }

    static function buildSubcategoryUrl($category, $subcategory){
        $catUrl = (isset($category->category_url) && !empty($category->category_url)) ? $category->category_url : '/';
        $subcatUrl = (isset($subcategory->subcategory_url) && !empty($subcategory->subcategory_url)) ? '/' . $subcategory->subcategory_url : '/';
        $url = (Str::contains($catUrl, (new self())->baseUrl)) ?  $catUrl : (new self())->baseUrl.'/'.$catUrl;
        $url .= $subcatUrl;

        return $url;
    }

    static function getMasaraProducts(){
        $products = self::where('product_status', 'published')
                        ->orderBy('ordering', 'DESC')
                        ->paginate(20);

        $products->map(function($product){
            $category = $product->mainCategory->first();
            $subcategory = $product->mainSubcategory->first();
            //$product->name =  Str::limit($product->name, 20);
            $product->mainImg  = '';
            $product->main_url = Products::buildProductUrl($product, $category, $subcategory);
//            $tva = Cart::getTVA();
//            $calculatedTva = Cart::extractTVA($product->price, $tva->tva, $tva->tax_type);
//            $product->price = $product->price + $calculatedTva;
        });

        return $products;

    }

    static function getResetFilteredProducts($filters){
        $filters = collect($filters);

        $productsQuery = self::where('products.product_status', '=', 'published');

        $mappedFilters = $filters->map(function ($filterValue, $filter) use ($productsQuery) {
            switch ($filter) {
                case 'categories':
                    $productsQuery->join('products_to_categories', 'products.id', '=', 'products_to_categories.product_id')
                        ->whereIn('products_to_categories.category_id', $filterValue);
                    break;

                case 'subcategories':
                    $productsQuery->join('products_to_subcategories', 'products.id', '=', 'products_to_subcategories.product_id')
                        ->whereIn('products_to_subcategories.subcategory_id', $filterValue);
                    break;
                case 'sorter':
                        //continue;
                    break;
                default:

                    $productsQuery->join('products_metas as '.$filter, 'products.id', '=', $filter.'.pid')
                        ->where($filter.'.meta_combined_key', '=', $filter)
                        ->whereIn($filter.'.meta_value', $filterValue);
                    break;
            }
        });
        $productsQuery->orderBy('products.ordering', 'DESC');
        $products = $productsQuery->select('products.*')->distinct()->paginate(20);

        $products->map(function($product){
            $category = $product->mainCategory->first();
            $subcategory = $product->mainSubcategory->first();
            //$product->name =  Str::limit($product->name, 20);
            $product->mainImg  = '';
            $product->main_url = Products::buildProductUrl($product, $category, $subcategory);
        });

        return $products;

    }

    static function getProductsByCategory($category){

        $products =  $category->products()->paginate(20);
        $products->map(function($product){
            $category = $product->categories->first();
            $subcategory = $product->subcategories->first();
            //$product->name =  Str::limit($product->name, 20);
            $product->mainImg  = '';
            $product->main_url = Products::buildProductUrl($product, $category, $subcategory);
        });

        return $products;
    }

    static function getProductsBySubcategory($subcategory){

        $products =  $subcategory->products()->paginate(20);

        $products->map(function($product){
            $category = $product->categories->first();
            $subcategory = $product->subcategories->first();
            //$product->name =  Str::limit($product->name, 20);
            $product->mainImg  = '';
            $product->main_url = Products::buildProductUrl($product, $category, $subcategory);
        });

        return $products;
    }


    static function getMainCategory($product){
        $mainCategory = $product->mainCategory->first();
        $mainCategory->main_category_url = self::buildCategoryUrl($mainCategory);
        return $mainCategory;
    }

    static function getNavigatedCategory($categorySEO){
        $navCategory = ProductsCategories::where('category_url', $categorySEO)->first();
        $navCategory->main_category_url = self::buildCategoryUrl($navCategory);
        return $navCategory;
    }

    static function getNavigatedSubcategory($category, $subcategorySEO){
        $subcategory = ProductsSubcategories::where('subcategory_url', $subcategorySEO)->first();
        $subcategory->main_subcategory_url = self::buildSubcategoryUrl($category, $subcategory);

        return $subcategory;
    }

    static function getCategory($categorySEO){
        $category = ProductsCategories::where('category_url', $categorySEO)->first();
        $category->main_category_url = self::buildCategoryUrl($category);
        $category->associatedMedia   = '';
        return $category;
    }
    static function getSubcategory($category, $subcategorySEO){
        $subcategory = ProductsSubcategories::where('subcategory_url', $subcategorySEO)->first();
        $subcategory->main_subcategory_url = self::buildSubcategoryUrl($category, $subcategory);
        $subcategory->associatedMedia      = '';

        return $subcategory;
    }


    static function getMainSubcategory($product){
        $mainCategory = $product->mainCategory->first();
        $mainSubcategory = $product->mainSubcategory->first();
        $mainSubcategory->main_subcategory_url = self::buildSubcategoryUrl($mainCategory, $mainSubcategory);
        return $mainSubcategory;
    }

    static function getAssociatedAttributes($product){
        $attributes = DB::table('products_metas')
                        ->select('meta_key', 'meta_attribute', 'meta_value')
                        ->where('pid', $product->id)
                        ->distinct()
                        ->orderBy('meta_key', 'ASC') // Add orderBy clause
                        ->get()
                        ->groupBy('meta_key')
                        ->map(function ($group) {
                            return $group->groupBy('meta_attribute')
                                ->map(function ($innerGroup) {
                                    return $innerGroup->pluck('meta_value')->unique()->values();
                                });
                        });
        return $attributes;
    }
    static function getProductInfos($product){
        $product->main_url = self::buildProductUrl($product, $product->mainCategory->first(), $product->mainSubcategory->first());
        $product->mainImg  = '';
        $product->gallery  = '';
        $product->components = self::getAssociatedAttributes($product);
        return $product;
    }
    static function getProductByUrl($productSEO){

        if(!empty($productSEO)){
            if(Auth::check()){
                $product = self::where('url', $productSEO)->first();
            }else{
                $product = self::where('url', $productSEO)->where('product_status', '=', 'published')->first();
            }

            if($product !=null){
                $product->main_url = self::buildProductUrl($product, $product->mainCategory->first(), $product->mainSubcategory->first());
                $product->mainImg  = '';
                $product->gallery  = '';
                $product->components = self::getAssociatedAttributes($product);
            }else{
                abort(404);
            }

        }else{
            abort(404);
        }

        return $product;
    }

    static function getProductByID($ID){

        if(!empty($ID)){
            $product = self::where('id', $ID)->where('product_status', '=', 'published')->first();
            if($product !=null){
                $product->main_url = self::buildProductUrl($product, $product->mainCategory->first(), $product->mainSubcategory->first());
                $product->mainImg  = '';
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

        return $product;
    }

    static function getDistinctAttribute(){
        $mainAttributes = DB::table('products_metas')
                            ->select('meta_attribute')
                            ->distinct()
                            ->get();
    }
    static function getAllCategoriesWithSubcategories(){
        $categories = ProductsCategories::with('subcategories')->get();
        return $categories;
    }
    static function getAreaFilters(){

        $areas = DB::table('products_areas')
                            ->select('*')
                            ->distinct()
                            ->orderBy('ordering', 'ASC')
                            ->where('status', 'published')
                            ->get();
        return $areas;
    }
    static function getAllAsociatedAttributes(){
        $distinctValues = DB::table('products_metas')
                            ->select('meta_key', 'meta_attribute', 'meta_value')
                            ->distinct()
                            ->orderBy('meta_key', 'ASC') // Add orderBy clause
                            ->get()
                            ->groupBy('meta_key')
                            ->map(function ($group) {
                                return $group->groupBy('meta_attribute')
                                    ->map(function ($innerGroup) {
                                        return $innerGroup->pluck('meta_value')->unique()->values();
                                    });
                            });
        return $distinctValues;

    }

    static function filterCategory(){
        $categoriesAndSubcategories = self::getAllCategoriesWithSubcategories();
        return $categoriesAndSubcategories;
    }
    static function filterArea(){
        $areaFilters = self::getAreaFilters();
        return $areaFilters;
    }

    static function filterAttributes(){
        $asociatedMetas = self::getAllAsociatedAttributes();
        return $asociatedMetas;
    }

    static function getFilteredProducts($filters){
        //echo '<pre>';print_r($filters);exit;
        $filters = collect($filters);

        $productsQuery = self::where('products.product_status', '=', 'published');

        $mappedFilters = $filters->map(function ($filterValue, $filter) use ($productsQuery) {
            switch ($filter) {
                case 'product_type':
                    $productsQuery->whereIn('products.product_type', $filterValue);
                    break;

                case 'categories':
                    $productsQuery->join('products_to_categories', 'products.id', '=', 'products_to_categories.product_id')
                        ->whereIn('products_to_categories.category_id', $filterValue);
                    break;

                case 'subcategories':
                    $productsQuery->join('products_to_subcategories', 'products.id', '=', 'products_to_subcategories.product_id')
                        ->whereIn('products_to_subcategories.subcategory_id', $filterValue);
                    break;

                case 'area':
                    $productsQuery->join('products_to_areas', 'products.id', '=', 'products_to_areas.product_id')
                        ->whereIn('products_to_areas.area_id', $filterValue);
                    break;
                case 'sorter':
                        //continue;
                    break;
                default:

                    $productsQuery->join('products_metas as '.$filter, 'products.id', '=', $filter.'.pid')
                        ->where($filter.'.meta_combined_key', '=', $filter)
                        ->whereIn($filter.'.meta_value', $filterValue);
                    break;
            }
        });

        if(isset($filters['sorter'][0]) && !empty($filters['sorter'][0])){
            switch ($filters['sorter'][0]) {
                case 'ieftin':
                    $productsQuery->orderBy('products.price', 'ASC');
                    break;

                case 'scump':
                    $productsQuery->orderBy('products.price', 'DESC');
                    break;
                default:
                    $productsQuery->orderBy('products.ordering', 'DESC');
                    break;
            }

        }else{
            $productsQuery->orderBy('products.ordering', 'DESC');
        }
        $filteredProducts = $productsQuery->select('products.*')->distinct()->paginate(20);

        $filteredProducts->map(function($product){
            $prod = self::where('id', $product->id)->where('product_status', '=', 'published')->first();
            $category = self::getMainCategory($prod);
            $subcategory = self::getMainSubcategory($prod);
            //$product->name =  Str::limit($prod->name, 20);
            $product->mainImg  = '';
            $product->main_url = Products::buildProductUrl($prod, $category, $subcategory);

        });

        return $filteredProducts;
    }

    static function trackProductHit($productId, $request){

        $sessionId = Session::getId();
        $IP = $request->ip();

        $hitRecord = DB::table('products_hits', $productId)
                ->where('product_id', $productId)
                ->where('session_id', $sessionId)
                ->where('ip', $IP)
                ->first();

        if (!$hitRecord) {
            $now = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('products_hits')->insert([
                'product_id' => $productId,
                'session_id' => $sessionId,
                'ip'         => $IP,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
