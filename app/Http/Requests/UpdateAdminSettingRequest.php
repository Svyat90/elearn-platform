<?php

namespace App\Http\Requests;

use App\AdminSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAdminSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('admin_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'artist_video_show_count_web' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'artist_video_show_count_app' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
