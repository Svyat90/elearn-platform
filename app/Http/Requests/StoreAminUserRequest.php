<?php

namespace App\Http\Requests;

use App\AminUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAminUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('amin_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'username' => [
                'max:256',
                'required',
                'unique:amin_users'],
            'password' => [
                'required'],
        ];

    }
}
