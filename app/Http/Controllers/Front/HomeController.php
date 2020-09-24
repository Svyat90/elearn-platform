<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends FrontController
{

    /**
     * @return View
     */
    public function index() : View
    {
        return view('front.home');
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToHome() : RedirectResponse
    {
        return response()->redirectToRoute('front.home');
    }

}
