@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderPayment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderPayment.fields.id') }}
                        </th>
                        <td>
                            {{ $orderPayment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderPayment.fields.order') }}
                        </th>
                        <td>
                            {{ $orderPayment->order->payment_status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderPayment.fields.payment_by') }}
                        </th>
                        <td>
                            {{ App\OrderPayment::PAYMENT_BY_SELECT[$orderPayment->payment_by] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderPayment.fields.booking_amount') }}
                        </th>
                        <td>
                            {{ $orderPayment->booking_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderPayment.fields.recieved_amount') }}
                        </th>
                        <td>
                            {{ $orderPayment->recieved_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderPayment.fields.payment_status') }}
                        </th>
                        <td>
                            {{ App\OrderPayment::PAYMENT_STATUS_SELECT[$orderPayment->payment_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderPayment.fields.pg_txnid') }}
                        </th>
                        <td>
                            {{ $orderPayment->pg_txnid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection