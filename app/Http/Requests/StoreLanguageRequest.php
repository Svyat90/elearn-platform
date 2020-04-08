<?php

namespace App\Http\Requests;

use App\Language;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLanguageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('language_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'     => [
                'max:256',
                'required',
                'unique:languages'],
            'iso_code' => [
                'max:256'],
        ];

    }
}
