<?php

namespace App\Http\Requests;

use App\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'video' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
