<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails {
        showLinkRequestForm as showLinkRequestFormTrait;
        sendResetLinkEmail as sendResetLinkEmailTrait;
    }

    /**
     * @return Response
     */
    public function showLinkRequestForm()
    {
        $locale = request()->input('locale');
        App::setLocale($locale);

        return $this->showLinkRequestFormTrait();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $locale = $request->input('locale');
        App::setLocale($locale);

        return $this->sendResetLinkEmailTrait($request);
    }

}
