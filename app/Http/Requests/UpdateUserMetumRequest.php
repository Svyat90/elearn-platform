<?php

namespace App\Http\Requests;

use App\UserMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserMetumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [

        ];

    }
}
