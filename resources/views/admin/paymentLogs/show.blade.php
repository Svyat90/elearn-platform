@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentLog.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentLog.fields.user') }}
                        </th>
                        <td>
                            {{ $paymentLog->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentLog.fields.order') }}
                        </th>
                        <td>
                            {{ $paymentLog->order->payment_status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentLog.fields.payment_info') }}
                        </th>
                        <td>
                            {!! $paymentLog->payment_info !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentLog.fields.amount') }}
                        </th>
                        <td>
                            {{ $paymentLog->amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection