<?php

namespace App\Http\Requests;

use App\UserWalletHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserWalletHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_wallet_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'txn_info' => [
                'max:256'],
        ];

    }
}
