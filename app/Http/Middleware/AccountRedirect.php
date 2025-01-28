<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Locomotif\Admin\Models\Users;

class AccountRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        if (Auth::check()) {
            $user = Users::find(Auth::user()->id);
            return redirect()->intended(redirectArea($user));
        }

        return $next($request);
    }
}
