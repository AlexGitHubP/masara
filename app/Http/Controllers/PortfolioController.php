<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\GeneralModel;
use App\Models\Cart as CartModel;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }

    public function list(){
        $items = Portfolio::getallPortfolios();
        $topProducts  = GeneralModel::getTopProducts(4);
        return view('portfolio.list')
            ->with(compact('items'))
            ->with(compact('topProducts'));
    }

    public function detail(Request $request, $blogSeo){
        $item = Portfolio::getDetail($blogSeo);
        $portfolioImages = Portfolio::getPortfolioImages($blogSeo);

        return view('portfolio.detail')
            ->with(compact('item'))
            ->with(compact('portfolioImages'));
    }
}
