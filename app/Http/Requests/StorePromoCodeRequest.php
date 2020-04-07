<?php

namespace App\Http\Requests;

use App\PromoCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePromoCodeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('promo_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'promo_code' => [
                'max:256'],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'end_date'   => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
        ];

    }
}
