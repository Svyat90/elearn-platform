<?php

namespace App\Http\Middleware;

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
        $permissionService = new PermissionService();

        if (Auth::guard($guard)->check() && $permissionService->loginUserHasAccessToAdminPanel()) {
            return $next($request);
        }

        return redirect()->route('front.home');
    }

}
