<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AccessCategories;
use App\User;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    use AccessCategories;

    /**
     * @var User|null
     */
    protected ? User $user = null;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            /** @var User $user */
            $user = Auth::user();
            $this->user = $user;
            $this->shareCategories($this->user);
            return $next($request);
        });
    }

}
