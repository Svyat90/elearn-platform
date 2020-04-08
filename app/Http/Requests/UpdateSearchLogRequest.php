<?php

namespace App\Http\Requests;

use App\SearchLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSearchLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('search_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'search_term' => [
                'max:256'],
        ];

    }
}
