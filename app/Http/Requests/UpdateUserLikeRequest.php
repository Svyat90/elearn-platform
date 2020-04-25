<?php

namespace App\Http\Requests;

use App\UserLike;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserLikeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_like_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
        ];

    }
}
