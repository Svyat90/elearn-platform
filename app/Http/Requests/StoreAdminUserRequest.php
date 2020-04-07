<?php

namespace App\Http\Requests;

use App\AdminUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAdminUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('admin_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'username' => [
                'max:256',
                'required',
                'unique:admin_users'],
            'password' => [
                'required'],
            'role_id'  => [
                'required',
                'integer'],
        ];

    }
}
