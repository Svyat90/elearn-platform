<?php

namespace App\Http\Requests;

use App\UserLanguage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserLanguageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_language_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
        ];

    }
}
