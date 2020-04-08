@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.agentPaymentHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agent-payment-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.txn_type') }}
                        </th>
                        <td>
                            {{ App\AgentPaymentHistory::TXN_TYPE_SELECT[$agentPaymentHistory->txn_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.any_fees') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->any_fees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.any_charges') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->any_charges }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.final_amount') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->final_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.txn_for') }}
                        </th>
                        <td>
                            {{ App\AgentPaymentHistory::TXN_FOR_SELECT[$agentPaymentHistory->txn_for] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.txn_info') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->txn_info }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.status') }}
                        </th>
                        <td>
                            {{ App\AgentPaymentHistory::STATUS_SELECT[$agentPaymentHistory->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.proccesed_by') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->proccesed_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.user') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->user->referred_by ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentPaymentHistory.fields.earn_from') }}
                        </th>
                        <td>
                            {{ $agentPaymentHistory->earn_from->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agent-payment-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection