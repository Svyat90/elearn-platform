<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AccessCategories;
use App\Http\Controllers\Traits\SettingTrait;
use App\User;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    use AccessCategories, SettingTrait;

    /**
     * @var User|null
     */
    protected ? User $user = null;

    /**
     * @var int
     */
    protected int $pageLimit = 24;

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
            $this->shareSettings();
            return $next($request);
        });
    }

}
