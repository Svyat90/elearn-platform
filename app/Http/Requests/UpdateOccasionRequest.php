<?php

namespace App\Http\Requests;

use App\Occasion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOccasionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('occasion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name' => [
                'max:256',
                'required'],
        ];

    }
}