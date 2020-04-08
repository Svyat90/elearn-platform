<?php

namespace App\Http\Requests;

use App\AdminSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAdminSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('admin_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'user_commission'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'artist_commission' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'agent_commission'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
