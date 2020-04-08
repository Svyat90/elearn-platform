@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.language.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.languages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.language.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="iso_code">{{ trans('cruds.language.fields.iso_code') }}</label>
                <input class="form-control {{ $errors->has('iso_code') ? 'is-invalid' : '' }}" type="text" name="iso_code" id="iso_code" value="{{ old('iso_code', '') }}">
                @if($errors->has('iso_code'))
                    <span class="text-danger">{{ $errors->first('iso_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.iso_code_helper') }}</span>
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