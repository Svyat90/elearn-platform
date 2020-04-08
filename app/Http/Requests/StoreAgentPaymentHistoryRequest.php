<?php

namespace App\Http\Requests;

use App\AgentPaymentHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAgentPaymentHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('agent_payment_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'proccesed_by' => [
                'max:256'],
        ];

    }
}
