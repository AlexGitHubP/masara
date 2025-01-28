<?php

namespace App\Http\Controllers;

use App\Models\GeneralModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart as CartModel;
use App\Models\Products as MasaraProducts;



class Products extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }

    function shop(){
        $products = MasaraProducts::getMasaraProducts();
        $filterCategory  = MasaraProducts::filterCategory();
        $filterArea  = MasaraProducts::filterArea();
        $filterAttributes  = MasaraProducts::filterAttributes();

        return view('products.shop')
                ->with(compact('products'))
                ->with(compact('filterCategory'))
                ->with(compact('filterArea'))
                ->with(compact('filterAttributes'));
    }

    function category(Request $request, $categorySEO){

        $category = MasaraProducts::getCategory($categorySEO);
        $products = MasaraProducts::getProductsByCategory($category);
        $breadcrumbs = buildCategoryBreadcrumb($category);
        $filterArea  = MasaraProducts::filterArea();
        $filterAttributes  = MasaraProducts::filterAttributes();

        return view('products.category')
            ->with(compact('products'))
            ->with(compact('category'))
            ->with(compact('breadcrumbs'))
            ->with(compact('filterArea'))
            ->with(compact('filterAttributes'));
    }

    function subcategory(Request $request, $categorySEO, $subcategorySEO){
        $category = MasaraProducts::getCategory($categorySEO);
        $subcategory = MasaraProducts::getSubcategory($category, $subcategorySEO);
        $products = MasaraProducts::getProductsBySubcategory($subcategory);
        $breadcrumbs = buildSubcategoryBreadcrumb($category, $subcategory);
        $filterArea  = MasaraProducts::filterArea();
        $filterAttributes  = MasaraProducts::filterAttributes();

        return view('products.subcategory')
                ->with(compact('products'))
                ->with(compact('category'))
                ->with(compact('subcategory'))
                ->with(compact('breadcrumbs'))
                ->with(compact('filterArea'))
                ->with(compact('filterAttributes'));
    }

    function product(Request $request, $categorySEO, $subcategorySEO, $product){
        $product = MasaraProducts::getProductInfos($product);
        MasaraProducts::trackProductHit($product->id, $request);
        $mainCategory = MasaraProducts::getMainCategory($product);
        $navCategory = MasaraProducts::getNavigatedCategory($categorySEO);
        $navSubcategory = MasaraProducts::getNavigatedSubcategory($navCategory, $subcategorySEO);
        $designer = (isset($product->designer)) ? $product->designer->name.' '.$product->designer->surname : 'MASARA';
        $breadcrumbs = buildProductBreadcrumb($navCategory, $navSubcategory, $product);
        $currentUrl = (isset($breadcrumbs[3]['url']) && !empty($breadcrumbs[3]['url'])) ? $breadcrumbs[3]['url'] : '';
        $isCanonical = ($currentUrl == $product->main_url) ? 1 : 0;
        $recommendedProducts = GeneralModel::getTopProducts();

        return view('products.product')
                ->with('product', $product)
                ->with('mainCategory', $mainCategory)
                ->with('designer', $designer)
                ->with('breadcrumbs', $breadcrumbs)
                ->with('recommendedProducts', $recommendedProducts);
    }

    public function getFilteredProducts(Request $request){

        $filters = $request->json()->all();
        if(isset($filters) && !empty($filters)){
            $response['products'] = MasaraProducts::getFilteredProducts($filters);
            $response['products']->withPath('/produse.html?');
            $response['pagination'] = $response['products']->links()->toHtml();
            $response['success']  = (isset($response['products']) && !empty($response['products']) && count($response['products']) > 0) ? true : false;
        }else{
            $response['products'] = false;
            $response['success']  = 0;
        }

        return response()->json($response);
    }
    public function clearProductFilters(Request $request){
        $filters = $request->json()->all();
        if(isset($filters) && !empty($filters)){
            $response['products'] = MasaraProducts::getResetFilteredProducts($filters);
        }else{
            $response['products'] = MasaraProducts::getMasaraProducts();
        }

        $response['products']->withPath('/produse.html?');
        $response['pagination'] = $response['products']->links()->toHtml();
        $response['success']  = (isset($response['products']) && !empty($response['products']) && count($response['products']) > 0) ? true : false;

        return response()->json($response);
    }


}

?>
