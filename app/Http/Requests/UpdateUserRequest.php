<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
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
            'roles.*'             => [
                'integer'],
            'roles'               => [
                'required',
                'array'],
            'name'                => [
                'required'],
            'first_name'          => [
                'max:256',
                'required'],
            'last_name'           => [
                'max:256'],
            'email'               => [
                'required',
                'unique:users,email,' . request()->route('user')->id],
            'dob'                 => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'position_occupation' => [
                'max:256'],
            'subscribers'         => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'bio'                 => [
                'max:256'],
        ];

    }
}
