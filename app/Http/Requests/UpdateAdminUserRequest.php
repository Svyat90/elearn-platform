<?php

namespace App\Http\Requests;

use App\AdminUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAdminUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('admin_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'username' => [
                'max:256',
                'required',
                'unique:admin_users,username,' . request()->route('admin_user')->id],
            'role_id'  => [
                'required',
                'integer'],
        ];

    }
}
