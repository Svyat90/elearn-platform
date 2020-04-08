<?php

namespace App\Http\Requests;

use App\UserMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserMetumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_metum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'user_wishlist' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
