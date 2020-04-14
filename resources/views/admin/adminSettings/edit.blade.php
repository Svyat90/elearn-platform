@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.adminSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.admin-settings.update", [$adminSetting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="key">{{ trans('cruds.adminSetting.fields.key') }}</label>
                <input class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" type="text" name="key" id="key" value="{{ old('key', $adminSetting->key) }}">
                @if($errors->has('key'))
                    <span class="text-danger">{{ $errors->first('key') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value">{{ trans('cruds.adminSetting.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number" name="value" id="value" value="{{ old('value', $adminSetting->value) }}" step="0.01">
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.value_helper') }}</span>
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