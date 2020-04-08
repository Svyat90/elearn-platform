<?php

namespace App\Http\Requests;

use App\AgentMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAgentMetumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('agent_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:agent_meta,id',
        ];

    }
}
