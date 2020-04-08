<?php

namespace App\Http\Requests;

use App\PaymentLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePaymentLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('payment_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
        ];

    }
}
