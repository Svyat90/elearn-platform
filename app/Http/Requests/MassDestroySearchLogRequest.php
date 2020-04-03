<?php

namespace App\Http\Requests;

use App\SearchLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySearchLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('search_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:search_logs,id',
        ];

    }
}
