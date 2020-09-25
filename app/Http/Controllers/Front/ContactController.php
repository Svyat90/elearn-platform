<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use Illuminate\View\View;

class ContactController extends FrontController
{

    /**
     * @return View
     */
    public function index() : View
    {
        $settings = collect();

        return view('front.contact', compact('settings'));
    }

}
