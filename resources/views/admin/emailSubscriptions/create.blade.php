@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.emailSubscription.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.email-subscriptions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="email_address">{{ trans('cruds.emailSubscription.fields.email_address') }}</label>
                <input class="form-control {{ $errors->has('email_address') ? 'is-invalid' : '' }}" type="email" name="email_address" id="email_address" value="{{ old('email_address') }}" required>
                @if($errors->has('email_address'))
                    <span class="text-danger">{{ $errors->first('email_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.emailSubscription.fields.email_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.emailSubscription.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\EmailSubscription::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.emailSubscription.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subscribed_on">{{ trans('cruds.emailSubscription.fields.subscribed_on') }}</label>
                <input class="form-control datetime {{ $errors->has('subscribed_on') ? 'is-invalid' : '' }}" type="text" name="subscribed_on" id="subscribed_on" value="{{ old('subscribed_on') }}">
                @if($errors->has('subscribed_on'))
                    <span class="text-danger">{{ $errors->first('subscribed_on') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.emailSubscription.fields.subscribed_on_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unsubscribed_on">{{ trans('cruds.emailSubscription.fields.unsubscribed_on') }}</label>
                <input class="form-control datetime {{ $errors->has('unsubscribed_on') ? 'is-invalid' : '' }}" type="text" name="unsubscribed_on" id="unsubscribed_on" value="{{ old('unsubscribed_on') }}">
                @if($errors->has('unsubscribed_on'))
                    <span class="text-danger">{{ $errors->first('unsubscribed_on') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.emailSubscription.fields.unsubscribed_on_helper') }}</span>
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