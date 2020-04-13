@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.order.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <td>
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.user') }}
                        </th>
                        <td>
                            {{ $order->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.message') }}
                        </th>
                        <td>
                            {{ $order->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.payment_status') }}
                        </th>
                        <td>
                            {{ App\Order::PAYMENT_STATUS_SELECT[$order->payment_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.language') }}
                        </th>
                        <td>
                            {{ $order->language->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.from_gender') }}
                        </th>
                        <td>
                            {{ $order->from_gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.video_to') }}
                        </th>
                        <td>
                            {{ $order->video_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.to_gender') }}
                        </th>
                        <td>
                            {{ $order->to_gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer_name') }}
                        </th>
                        <td>
                            {{ $order->customer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.occasion_type') }}
                        </th>
                        <td>
                            {{ $order->occasion_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.delivery_email') }}
                        </th>
                        <td>
                            {{ $order->delivery_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.delivery_phone') }}
                        </th>
                        <td>
                            {{ $order->delivery_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.promo_code') }}
                        </th>
                        <td>
                            {{ $order->promo_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.promo_discount') }}
                        </th>
                        <td>
                            {{ $order->promo_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.booking_amount') }}
                        </th>
                        <td>
                            {{ $order->booking_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.booking_datetime') }}
                        </th>
                        <td>
                            {{ $order->booking_datetime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.payment_by') }}
                        </th>
                        <td>
                            {{ App\Order::PAYMENT_BY_SELECT[$order->payment_by] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.order_status') }}
                        </th>
                        <td>
                            {{ App\Order::ORDER_STATUS_SELECT[$order->order_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.artist') }}
                        </th>
                        <td>
                            {{ $order->artist->display_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.video_for') }}
                        </th>
                        <td>
                            {{ App\Order::VIDEO_FOR_SELECT[$order->video_for] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.video_from') }}
                        </th>
                        <td>
                            {{ App\Order::VIDEO_FROM_SELECT[$order->video_from] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.hide_video') }}
                        </th>
                        <td>
                            {{ App\Order::HIDE_VIDEO_SELECT[$order->hide_video] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#order_order_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.orderPayment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_payment_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentLog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_artist_responses" role="tab" data-toggle="tab">
                {{ trans('cruds.artistResponse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="order_order_payments">
            @includeIf('admin.orders.relationships.orderOrderPayments', ['orderPayments' => $order->orderOrderPayments])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_payment_logs">
            @includeIf('admin.orders.relationships.orderPaymentLogs', ['paymentLogs' => $order->orderPaymentLogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_artist_responses">
            @includeIf('admin.orders.relationships.orderArtistResponses', ['artistResponses' => $order->orderArtistResponses])
        </div>
    </div>
</div>

@endsection