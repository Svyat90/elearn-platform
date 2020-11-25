<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'roles.*'       => 'integer',
            'roles'         => 'required|array',
            'first_name'    => 'sometimes|max:255',
            'last_name'     => 'sometimes|max:255',
            'email'         => 'required|unique:users,email,' . request()->route('user')->id,
            'position'      => 'max:255',
            'institution'   => 'max:255',
            'phone'         => 'max:255',
            'user_status'   => 'required|' . Rule::in(array_keys(User::USER_STATUS_SELECT))
        ];
    }
}
