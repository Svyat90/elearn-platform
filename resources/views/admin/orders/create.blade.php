@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.order.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="message">{{ trans('cruds.order.fields.message') }}</label>
                <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" type="text" name="message" id="message" value="{{ old('message', '') }}" required>
                @if($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.payment_status') }}</label>
                <select class="form-control {{ $errors->has('payment_status') ? 'is-invalid' : '' }}" name="payment_status" id="payment_status">
                    <option value disabled {{ old('payment_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Order::PAYMENT_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_status'))
                    <span class="text-danger">{{ $errors->first('payment_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.payment_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="language_id">{{ trans('cruds.order.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id">
                    @foreach($languages as $id => $language)
                        <option value="{{ $id }}" {{ old('language_id') == $id ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <span class="text-danger">{{ $errors->first('language') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from_gender">{{ trans('cruds.order.fields.from_gender') }}</label>
                <input class="form-control {{ $errors->has('from_gender') ? 'is-invalid' : '' }}" type="text" name="from_gender" id="from_gender" value="{{ old('from_gender', '') }}">
                @if($errors->has('from_gender'))
                    <span class="text-danger">{{ $errors->first('from_gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.from_gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_to">{{ trans('cruds.order.fields.video_to') }}</label>
                <input class="form-control {{ $errors->has('video_to') ? 'is-invalid' : '' }}" type="text" name="video_to" id="video_to" value="{{ old('video_to', '') }}">
                @if($errors->has('video_to'))
                    <span class="text-danger">{{ $errors->first('video_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.video_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to_gender">{{ trans('cruds.order.fields.to_gender') }}</label>
                <input class="form-control {{ $errors->has('to_gender') ? 'is-invalid' : '' }}" type="text" name="to_gender" id="to_gender" value="{{ old('to_gender', '') }}">
                @if($errors->has('to_gender'))
                    <span class="text-danger">{{ $errors->first('to_gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.to_gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_name">{{ trans('cruds.order.fields.customer_name') }}</label>
                <input class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}" type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', '') }}">
                @if($errors->has('customer_name'))
                    <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="occasion_type_id">{{ trans('cruds.order.fields.occasion_type') }}</label>
                <select class="form-control select2 {{ $errors->has('occasion_type') ? 'is-invalid' : '' }}" name="occasion_type_id" id="occasion_type_id">
                    @foreach($occasion_types as $id => $occasion_type)
                        <option value="{{ $id }}" {{ old('occasion_type_id') == $id ? 'selected' : '' }}>{{ $occasion_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('occasion_type'))
                    <span class="text-danger">{{ $errors->first('occasion_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.occasion_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_email">{{ trans('cruds.order.fields.delivery_email') }}</label>
                <input class="form-control {{ $errors->has('delivery_email') ? 'is-invalid' : '' }}" type="text" name="delivery_email" id="delivery_email" value="{{ old('delivery_email', '') }}">
                @if($errors->has('delivery_email'))
                    <span class="text-danger">{{ $errors->first('delivery_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.delivery_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_phone">{{ trans('cruds.order.fields.delivery_phone') }}</label>
                <input class="form-control {{ $errors->has('delivery_phone') ? 'is-invalid' : '' }}" type="text" name="delivery_phone" id="delivery_phone" value="{{ old('delivery_phone', '') }}">
                @if($errors->has('delivery_phone'))
                    <span class="text-danger">{{ $errors->first('delivery_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.delivery_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="promo_code">{{ trans('cruds.order.fields.promo_code') }}</label>
                <input class="form-control {{ $errors->has('promo_code') ? 'is-invalid' : '' }}" type="text" name="promo_code" id="promo_code" value="{{ old('promo_code', '') }}">
                @if($errors->has('promo_code'))
                    <span class="text-danger">{{ $errors->first('promo_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.promo_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="promo_discount">{{ trans('cruds.order.fields.promo_discount') }}</label>
                <input class="form-control {{ $errors->has('promo_discount') ? 'is-invalid' : '' }}" type="number" name="promo_discount" id="promo_discount" value="{{ old('promo_discount', '') }}" step="0.01">
                @if($errors->has('promo_discount'))
                    <span class="text-danger">{{ $errors->first('promo_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.promo_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_amount">{{ trans('cruds.order.fields.booking_amount') }}</label>
                <input class="form-control {{ $errors->has('booking_amount') ? 'is-invalid' : '' }}" type="number" name="booking_amount" id="booking_amount" value="{{ old('booking_amount', '') }}" step="0.01">
                @if($errors->has('booking_amount'))
                    <span class="text-danger">{{ $errors->first('booking_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.booking_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_datetime">{{ trans('cruds.order.fields.booking_datetime') }}</label>
                <input class="form-control datetime {{ $errors->has('booking_datetime') ? 'is-invalid' : '' }}" type="text" name="booking_datetime" id="booking_datetime" value="{{ old('booking_datetime') }}">
                @if($errors->has('booking_datetime'))
                    <span class="text-danger">{{ $errors->first('booking_datetime') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.booking_datetime_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.payment_by') }}</label>
                <select class="form-control {{ $errors->has('payment_by') ? 'is-invalid' : '' }}" name="payment_by" id="payment_by">
                    <option value disabled {{ old('payment_by', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Order::PAYMENT_BY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_by', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_by'))
                    <span class="text-danger">{{ $errors->first('payment_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.payment_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.order_status') }}</label>
                <select class="form-control {{ $errors->has('order_status') ? 'is-invalid' : '' }}" name="order_status" id="order_status">
                    <option value disabled {{ old('order_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Order::ORDER_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('order_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_status'))
                    <span class="text-danger">{{ $errors->first('order_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_id">{{ trans('cruds.order.fields.artist') }}</label>
                <select class="form-control select2 {{ $errors->has('artist') ? 'is-invalid' : '' }}" name="artist_id" id="artist_id">
                    @foreach($artists as $id => $artist)
                        <option value="{{ $id }}" {{ old('artist_id') == $id ? 'selected' : '' }}>{{ $artist }}</option>
                    @endforeach
                </select>
                @if($errors->has('artist'))
                    <span class="text-danger">{{ $errors->first('artist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.artist_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.video_for') }}</label>
                <select class="form-control {{ $errors->has('video_for') ? 'is-invalid' : '' }}" name="video_for" id="video_for">
                    <option value disabled {{ old('video_for', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Order::VIDEO_FOR_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('video_for', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('video_for'))
                    <span class="text-danger">{{ $errors->first('video_for') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.video_for_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.video_from') }}</label>
                <select class="form-control {{ $errors->has('video_from') ? 'is-invalid' : '' }}" name="video_from" id="video_from">
                    <option value disabled {{ old('video_from', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Order::VIDEO_FROM_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('video_from', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('video_from'))
                    <span class="text-danger">{{ $errors->first('video_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.video_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.hide_video') }}</label>
                <select class="form-control {{ $errors->has('hide_video') ? 'is-invalid' : '' }}" name="hide_video" id="hide_video">
                    <option value disabled {{ old('hide_video', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Order::HIDE_VIDEO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('hide_video', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('hide_video'))
                    <span class="text-danger">{{ $errors->first('hide_video') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.hide_video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order">{{ trans('cruds.orde.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order_id') ? 'is-invalid' : '' }}" type="text" name="order_id" id="order_id" value="{{ old('order_id', '') }}" step="1">
                @if($errors->has('order_id'))
                    <span class="text-danger">{{ $errors->first('order_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order_id.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_pin">{{ trans('cruds.order.fields.order_pin') }}</label>
                <input class="form-control {{ $errors->has('order_pin') ? 'is-invalid' : '' }}" type="number" name="order_pin" id="order_pin" value="{{ old('order_pin', '') }}" step="1">
                @if($errors->has('order_pin'))
                    <span class="text-danger">{{ $errors->first('order_pin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_pin_helper') }}</span>
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