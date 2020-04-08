<?php

namespace App\Http\Requests;

use App\LoginLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLoginLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('login_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ip_address' => [
                'max:20'],
            'device'     => [
                'max:256'],
        ];

    }
}
