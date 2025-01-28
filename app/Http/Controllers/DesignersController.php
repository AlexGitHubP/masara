<?php

namespace App\Http\Controllers;

use App\Models\Cart as CartModel;
use App\Models\DesignerAccount;
use Illuminate\Http\Request;
use \App\Models\Account;
use Illuminate\Support\Str;
use Locomotif\Media\Models\Media;

class DesignersController extends Controller
{

    protected $table ='';
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function designers(Request $request)
    {
        $designers = Account::designer()->status(Account::STATUS_PUBLISHED)->withDesignerSeoUrl()->get();
        $designers->map(function($designer){
            $designer->name = Str::ucfirst($designer->name);
            $designer->surname = Str::ucfirst($designer->surname);
            $designer->image = Media::getMainImage($designer->getTable(), $designer->id, false);
        });

        return view('accounts.designers.designers_main')
            ->with(compact('designers'));
    }
    function designers_products_list(){
        return view('accounts.designers.product_list');
    }
    function designers_detail(Request $request, $designerSeo){

        $designer = Account::designer()->status(Account::STATUS_PUBLISHED)->where('url', $designerSeo)->withDesignerSeoUrl()->first();
        $designer->img = Media::getMainImage($designer->getTable(), $designer->id, false);
        $designer->name = Str::ucfirst($designer->name);
        $designer->surname = Str::ucfirst($designer->surname);

        $designerProducts = DesignerAccount::getDesignerProducts($designer->id, 50);

        $recommendedDesigners = Account::designer()->status(Account::STATUS_PUBLISHED)->withDesignerSeoUrl()->inRandomOrder()->skip(0)->take(10)->get();;
        $recommendedDesigners->map(function($designer){
            $designer->name = Str::ucfirst($designer->name);
            $designer->surname = Str::ucfirst($designer->surname);
            $designer->image = Media::getMainImage($designer->getTable(), $designer->id, false);
        });

        return view('accounts.designers.designer_detail')
            ->with(compact('designer'))
            ->with(compact('designerProducts'))
            ->with(compact('recommendedDesigners'));
    }


}
