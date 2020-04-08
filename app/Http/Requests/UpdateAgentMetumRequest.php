<?php

namespace App\Http\Requests;

use App\AgentMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAgentMetumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('agent_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'state'         => [
                'max:256'],
            'city'          => [
                'max:256'],
            'agent_status'  => [
                'max:256'],
            'registered_on' => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
        ];

    }
}
