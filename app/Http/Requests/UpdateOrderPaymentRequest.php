<?php

namespace App\Http\Requests;

use App\OrderPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrderPaymentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('order_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
        ];

    }
}
