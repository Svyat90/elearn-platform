@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.loginLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.login-logs.update", [$loginLog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.loginLog.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($loginLog->user ? $loginLog->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.loginLog.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ip_address">{{ trans('cruds.loginLog.fields.ip_address') }}</label>
                <input class="form-control {{ $errors->has('ip_address') ? 'is-invalid' : '' }}" type="text" name="ip_address" id="ip_address" value="{{ old('ip_address', $loginLog->ip_address) }}">
                @if($errors->has('ip_address'))
                    <span class="text-danger">{{ $errors->first('ip_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.loginLog.fields.ip_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.loginLog.fields.login_from') }}</label>
                <select class="form-control {{ $errors->has('login_from') ? 'is-invalid' : '' }}" name="login_from" id="login_from">
                    <option value disabled {{ old('login_from', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\LoginLog::LOGIN_FROM_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('login_from', $loginLog->login_from) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('login_from'))
                    <span class="text-danger">{{ $errors->first('login_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.loginLog.fields.login_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="device">{{ trans('cruds.loginLog.fields.device') }}</label>
                <input class="form-control {{ $errors->has('device') ? 'is-invalid' : '' }}" type="text" name="device" id="device" value="{{ old('device', $loginLog->device) }}">
                @if($errors->has('device'))
                    <span class="text-danger">{{ $errors->first('device') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.loginLog.fields.device_helper') }}</span>
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