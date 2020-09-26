<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Contact\SendContactRequest;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends FrontController
{

    /**
     * @return View
     */
    public function index() : View
    {
        return view('front.contact');
    }

    /**
     * @param ContactService $contactService
     * @param SendContactRequest $request
     * @return RedirectResponse
     */
    public function send(ContactService $contactService, SendContactRequest $request) : RedirectResponse
    {
        $contactService->sendEmailToAdmin($request);

        return redirect()
            ->back()
            ->with('message', __('contact.success_sent'));
    }

}
