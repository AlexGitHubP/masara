<?php

namespace App\Http\Controllers;

use App\Models\Cart as CartModel;
use Illuminate\Http\Request;

class Clients extends Controller
{
    public function __construct(){
        $cartInfos = CartModel::getCart();
        view()->share(compact('cartInfos'));
    }
    
    public function dashboard(){
        return view('accounts.clients.dashboard');
    }

    public function orders(){
        return view('accounts.clients.orders');
    }

    public function favourites(){
        return view('accounts.clients.favourites');
    }

    public function editAccount(){
        return view('accounts.clients.editAccount');
    }
    
    
}
