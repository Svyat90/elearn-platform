<?php

namespace App\Http\Requests;

use App\OrderHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOrderHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('order_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:order_histories,id',
        ];

    }
}
