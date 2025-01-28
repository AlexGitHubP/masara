<?php

namespace App\Http\Controllers;


use App\Models\GeneralModel;
use App\Models\Products;
use App\Models\Cart as CartModel;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Locomotif\Media\Models\Media;

class GeneralPages extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }

    function homepage(){

        $topProducts  = GeneralModel::getTopProducts();
        $topDesigners = GeneralModel::getTopDesigners();

        $categoriesMasara = ProductCategory::published(ProductCategory::STATUS_PUBLISHED)->skip(0)->take(2)->get()->transform(function ($category){
            $category->nice_url = $category->withTypeFilter(Products::PRODUCT_TYPE_MASARA);
            $category->img = '';
            return $category;
        });

        $categoriesDesigner = ProductCategory::published(ProductCategory::STATUS_PUBLISHED)->skip(0)->take(2)->get()->map(function($category){
            $category->nice_url = $category->withTypeFilter(Products::PRODUCT_TYPE_DESIGNER);
            $category->img = '';
            return $category;
        });

        $subcategoriesMasara = ProductSubcategory::published(ProductSubcategory::STATUS_PUBLISHED)->skip(0)->take(4)->get()->map(function($subcategory){
            $subcategory->nice_url = $subcategory->withTypeFilter(Products::PRODUCT_TYPE_MASARA);
            $subcategory->img = '';
            return $subcategory;
        });

        $subcategoriesDesigner = ProductSubcategory::published(ProductSubcategory::STATUS_PUBLISHED)->skip(0)->take(4)->get()->map(function($subcategory){
            $subcategory->nice_url = $subcategory->withTypeFilter(Products::PRODUCT_TYPE_DESIGNER);
            $subcategory->img = '';
            return $subcategory;
        });

        return view('generalPages.homepage')
                ->with(compact('topProducts'))
                ->with(compact('topDesigners'))
                ->with(compact('categoriesMasara'))
                ->with(compact('categoriesDesigner'))
                ->with(compact('subcategoriesMasara'))
                ->with(compact('subcategoriesDesigner'));
    }

    function contact(){
        $judete = GeneralModel::getDistinctCounty();
        return view('generalPages.contact')
            ->with(compact('judete'));
    }

    function aboutUs(){
        return view('generalPages.aboutUs');
    }

    function faq(){
        return view('generalPages.faq');
    }

    function cookiesPolicy(){
        return view('generalPages.cookiesPolicy');
    }

    function gdprPolicy(){
        return view('generalPages.gdprPolicy');
    }

    function termsAndConditions(){
        return view('generalPages.termsAndConditions');
    }

    function masaraBrand(){
        return view('generalPages.masaraBrand');
    }








}
