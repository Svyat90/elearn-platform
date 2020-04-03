<?php

namespace App\Http\Requests;

use App\OrderHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrderHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('order_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'videos.*' => [
                'integer'],
            'videos'   => [
                'array'],
        ];

    }
}
