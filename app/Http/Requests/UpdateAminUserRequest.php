<?php

namespace App\Http\Requests;

use App\AminUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAminUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('amin_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'username' => [
                'max:256',
                'required',
                'unique:amin_users,username,' . request()->route('amin_user')->id],
        ];

    }
}
