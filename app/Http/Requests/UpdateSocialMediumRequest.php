<?php

namespace App\Http\Requests;

use App\SocialMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSocialMediumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('social_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'       => [
                'max:256',
                'required',
                'unique:social_media,name,' . request()->route('social_medium')->id],
            'short_code' => [
                'max:256'],
        ];

    }
}
