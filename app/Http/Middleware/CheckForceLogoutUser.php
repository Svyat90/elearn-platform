<?php

namespace App\Http\Middleware;

use Closure;

class CheckForceLogoutUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->force_logout === true) {
            auth()->logout();

            if ($request->ajax()) {
                return response()->json([
                    'errors' => ['User not active']
                ])->setStatusCode(403);

            } else {
                return redirect()->route('admin.home');
            }
        }

        return $next($request);
    }
}
