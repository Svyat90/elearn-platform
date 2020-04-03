<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserLanguage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLanguageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_language_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLanguages = UserLanguage::all();

        return view('admin.userLanguages.index', compact('userLanguages'));
    }
}
