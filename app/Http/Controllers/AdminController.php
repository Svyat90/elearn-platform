<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TranslationTrait;

class AdminController extends Controller
{
    use TranslationTrait;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->shareTranslations();
    }

}
