<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use \App\Services\PermissionService;

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
            /** @var User $user */
            $user = Auth::user();
            if($user->roles[0]->id !== PermissionService::ROLE_ADMIN_ID) {
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
