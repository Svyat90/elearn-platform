@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.orderPayment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-payments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="order_id">{{ trans('cruds.orderPayment.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $order)
                        <option value="{{ $id }}" {{ old('order_id') == $id ? 'selected' : '' }}>{{ $order }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <span class="text-danger">{{ $errors->first('order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.orderPayment.fields.payment_by') }}</label>
                <select class="form-control {{ $errors->has('payment_by') ? 'is-invalid' : '' }}" name="payment_by" id="payment_by">
                    <option value disabled {{ old('payment_by', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\OrderPayment::PAYMENT_BY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_by', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_by'))
                    <span class="text-danger">{{ $errors->first('payment_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.payment_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_amount">{{ trans('cruds.orderPayment.fields.booking_amount') }}</label>
                <input class="form-control {{ $errors->has('booking_amount') ? 'is-invalid' : '' }}" type="number" name="booking_amount" id="booking_amount" value="{{ old('booking_amount', '') }}" step="0.01">
                @if($errors->has('booking_amount'))
                    <span class="text-danger">{{ $errors->first('booking_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.booking_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="recieved_amount">{{ trans('cruds.orderPayment.fields.recieved_amount') }}</label>
                <input class="form-control {{ $errors->has('recieved_amount') ? 'is-invalid' : '' }}" type="number" name="recieved_amount" id="recieved_amount" value="{{ old('recieved_amount', '') }}" step="0.01">
                @if($errors->has('recieved_amount'))
                    <span class="text-danger">{{ $errors->first('recieved_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.recieved_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.orderPayment.fields.payment_status') }}</label>
                <select class="form-control {{ $errors->has('payment_status') ? 'is-invalid' : '' }}" name="payment_status" id="payment_status">
                    <option value disabled {{ old('payment_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\OrderPayment::PAYMENT_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_status'))
                    <span class="text-danger">{{ $errors->first('payment_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.payment_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pg_txnid">{{ trans('cruds.orderPayment.fields.pg_txnid') }}</label>
                <input class="form-control {{ $errors->has('pg_txnid') ? 'is-invalid' : '' }}" type="text" name="pg_txnid" id="pg_txnid" value="{{ old('pg_txnid', '') }}">
                @if($errors->has('pg_txnid'))
                    <span class="text-danger">{{ $errors->first('pg_txnid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.pg_txnid_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection