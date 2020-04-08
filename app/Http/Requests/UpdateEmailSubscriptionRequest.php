<?php

namespace App\Http\Requests;

use App\EmailSubscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateEmailSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('email_subscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'email_address'   => [
                'required',
                'unique:email_subscriptions,email_address,' . request()->route('email_subscription')->id],
            'subscribed_on'   => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
            'unsubscribed_on' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
        ];

    }
}
