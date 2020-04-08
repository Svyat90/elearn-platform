<?php

namespace App\Http\Requests;

use App\Occasion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreOccasionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('occasion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
