<?php

namespace App\Http\Requests;

use App\AgentPaymentHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAgentPaymentHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('agent_payment_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:agent_payment_histories,id',
        ];

    }
}
