<?php

namespace App\Http\Requests;

use App\User;
use Gate;
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
            'roles.*'       => [
                'integer'],
            'roles'         => [
                'required',
                'array'],
            'name'          => [
                'required'],
            'first_name'    => [
                'max:256',
                'required'],
            'last_name'     => [
                'max:256'],
            'email'         => [
                'required',
                'unique:users'],
            'mobile_no'     => [
                'max:200'],
            'password'      => [
                'required'],
            'ig_token'      => [
                'max:256'],
            'ig_username'   => [
                'max:256'],
            'birth_date'    => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'registered_on' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
        ];

    }
}
