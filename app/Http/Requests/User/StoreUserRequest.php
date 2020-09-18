<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'roles.*' => ['integer'],
            'roles' => ['required', 'array'],
            'first_name' => ['max:255', 'required'],
            'last_name' => ['max:255'],
            'position' => ['max:255'],
            'institution' => ['max:255'],
            'phone' => ['max:255'],
            'email' => ['required', 'unique:users'],
            'password' => ['required'],
        ];

    }
}
