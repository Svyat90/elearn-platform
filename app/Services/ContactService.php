<?php

namespace App\Services;

use App\Http\Requests\Front\Contact\SendContactRequest;
use App\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactService extends AbstractAccessService
{

    /**
     * @param SendContactRequest $request
     */
    public function sendEmailToAdmin(SendContactRequest $request) : void
    {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'body' => $request->message
        ];

        $emailTo = Setting::query()
            ->where('key', 'email')
            ->first()
            ->val;

        Mail::send('mail.contact', $data, function ($message) use ($emailTo) {
            $message
                ->to($emailTo)
                ->subject('Contact Form');
        });

        $this->checkFailures();
    }

    private function checkFailures() : void
    {
        $failures = Mail::failures();
        if (count($failures) > 0) {
            Log::error(json_encode($failures));
            foreach($failures as $emailAddress) {
                $msg = 'Error send mail: ' . $emailAddress;
                Log::error($msg);
            }
        }
    }

}
