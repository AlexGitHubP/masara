<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Products as MasaraProducts;
use App\Models\DesignerAccount;
use App\Models\Account as AccountModel;

use Locomotif\Media\Models\Media;
use Locomotif\Media\Controller\MediaController;

class GeneralModel extends Model{

    static function getTopProducts(){
        $products = DB::table('products_hits')
                        ->select('product_id', DB::raw('count(*) as total'))
                        ->groupBy('product_id')
                        ->orderBY('total', 'DESC')
                        ->limit(10)
                        ->get();
        $products->map(function($product){
            $product->detail = MasaraProducts::getProductByID($product->product_id);
        });
        
        return $products;
    }

    static function getTopDesigners(){

        $designers = DB::table('accounts')
                        ->join('products', 'accounts.id', '=', 'products.designer_id')
                        ->select('accounts.*', DB::raw('COUNT(products.designer_id) AS total_products'))
                        ->where('accounts.type', '=', 'designer')
                        ->where('products.product_status', '=', 'published')
                        ->groupBy('accounts.id')
                        ->orderBY('total_products', 'DESC')
                        ->limit(10)
                        ->get();
                        
        $designers->map(function($designer){
            $designer->image   = AccountModel::getProfilePicture($designer->id, 'accounts');
            $designer->mainUrl = DesignerAccount::getDesignerUrl($designer);
        });
        

        return $designers;
    }
    
    static function getDistinctCounty(){
        $countyList = DB::table('localitati')
                      ->select('judet')
                      ->distinct()
                      ->orderBy('judet', 'ASC')
                      ->get();
        return $countyList;
    }
}
