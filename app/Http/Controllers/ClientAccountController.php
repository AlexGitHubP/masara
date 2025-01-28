<?php

namespace App\Http\Controllers;

use App\Models\ClientAccount;
use App\Models\Cart as CartModel;
use Illuminate\Http\Request;
use Exception;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Locomotif\Admin\Models\Users;
use Locomotif\Clients\Models\Clients;

class ClientAccountController extends Controller
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
    public function index(){
        return view('accounts.create_client_account');
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

    public function edit(ClientAccount $clientAccount){
        return view('accounts.clients.editAccount');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


   


}
