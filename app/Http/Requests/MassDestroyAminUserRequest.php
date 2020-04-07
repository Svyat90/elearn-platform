<?php

namespace App\Http\Requests;

use App\AminUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAminUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('amin_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:amin_users,id',
        ];

    }
}
