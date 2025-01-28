<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Locomotif\Admin\Models\Users;
use Closure;


class AccountsGate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    //redirect to login if user not authenticated. No gate used. 
    public function handle($request, Closure $next, $role)
    {
        
        //daca nu e logat, redirect spre login
        if (!Auth::check()) {
            if (!$request->expectsJson()) {
                return redirect('/login.html');
            }
        }

        //diferite actiuni, in functie de rol
        if(isset($role) && !empty($role)){
            $user = Users::find(Auth::user()->id);
            switch ($role) {
                case 'client':
                    if($user->roles->pluck('name')->contains($role)){
                        return $next($request);
                    }else{
                        return redirect('/login.html');
                    }
                break;

                case 'designer':
                    if($user->roles->pluck('name')->contains($role)){
                        return $next($request);
                    }else{
                        return redirect('/login.html');
                    }
                case 'sharedOperations':
                    if($user->roles->pluck('name')->contains($role)){
                        return $next($request);
                    }else{
                        return redirect('/login.html');
                    }
                break;
                
                default:
                    return redirect('/login.html');
                break;
            }
        }else{
            return redirect('/login.html');
        }

    }
}
