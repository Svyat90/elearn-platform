@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.orderPayment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-payments.update", [$orderPayment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="order_id">{{ trans('cruds.orderPayment.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $order)
                        <option value="{{ $id }}" {{ ($orderPayment->order ? $orderPayment->order->id : old('order_id')) == $id ? 'selected' : '' }}>{{ $order }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <span class="text-danger">{{ $errors->first('order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.orderPayment.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $orderPayment->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.orderPayment.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $orderPayment->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.orderPayment.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $orderPayment->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.orderPayment.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $orderPayment->phone) }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="text">{{ trans('cruds.orderPayment.fields.text') }}</label>
                <input class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" type="text" name="text" id="text" value="{{ old('text', $orderPayment->text) }}">
                @if($errors->has('text'))
                    <span class="text-danger">{{ $errors->first('text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderPayment.fields.text_helper') }}</span>
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