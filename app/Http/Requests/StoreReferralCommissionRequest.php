<?php

namespace App\Http\Requests;

use App\ReferralCommission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreReferralCommissionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('referral_commission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'user_commission'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'artist_commission' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'agent_commission'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
