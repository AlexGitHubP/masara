<?php


if(!function_exists('buildProductBreadcrumb')){
    function buildProductBreadcrumb($category, $subcategory, $product){

        $breadcrumbs = [
            ['name' => 'Shop', 'url' => '/produse.html'],
            ['name' => ucfirst($category->category_name), 'url' => $category->main_category_url],
            ['name' => ucfirst($subcategory->subcategory_name), 'url' => $subcategory->main_subcategory_url],
            ['name' => ucfirst($product->name), 'url' => '/produse/'.$category->category_url.'/'.$subcategory->subcategory_url.'/'.$product->url.'.html'],
        ];
        
        
        return $breadcrumbs;
    }
}

if(!function_exists('buildCategoryBreadcrumb')){
    function buildCategoryBreadcrumb($mainCategory){

        $breadcrumbs = [
            ['name' => 'Shop', 'url' => '/produse.html'],
            ['name' => ucfirst($mainCategory->category_name), 'url' => $mainCategory->main_category_url],
        ];
        
        return $breadcrumbs;
    }
}

if(!function_exists('buildSubcategoryBreadcrumb')){
    function buildSubcategoryBreadcrumb($mainCategory, $mainSubcategory){

        $breadcrumbs = [
            ['name' => 'Shop', 'url' => '/produse.html'],
            ['name' => ucfirst($mainCategory->category_name), 'url' => $mainCategory->main_category_url],
            ['name' => ucfirst($mainSubcategory->subcategory_name), 'url' => $mainSubcategory->main_subcategory_url]
        ];
        
        return $breadcrumbs;
    }
}



?>