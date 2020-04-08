<?php

namespace App\Http\Requests;

use App\UserWalletHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserWalletHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_wallet_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_wallet_histories,id',
        ];

    }
}
