<?php

namespace App\Http\Requests;

use App\PageSeo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePageSeoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('page_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'page_url'   => [
                'max:256'],
            'meta_title' => [
                'max:256',
                'required'],
        ];

    }
}
