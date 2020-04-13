<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if($user->roles[0]->id != 1) {
                auth()->logout();
                Session()->flush();
                return redirect('/login')->with('message', "You don't have permission to login in.");
            }
        } else {
            auth()->logout();
            Session()->flush();
            return redirect('/login');
        }
        return $next($request);
    }
}
