@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.adminSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.admin-settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_commission">{{ trans('cruds.adminSetting.fields.user_commission') }}</label>
                <input class="form-control {{ $errors->has('user_commission') ? 'is-invalid' : '' }}" type="number" name="user_commission" id="user_commission" value="{{ old('user_commission', '0') }}" step="1">
                @if($errors->has('user_commission'))
                    <span class="text-danger">{{ $errors->first('user_commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.user_commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_commission">{{ trans('cruds.adminSetting.fields.artist_commission') }}</label>
                <input class="form-control {{ $errors->has('artist_commission') ? 'is-invalid' : '' }}" type="number" name="artist_commission" id="artist_commission" value="{{ old('artist_commission', '0') }}" step="1">
                @if($errors->has('artist_commission'))
                    <span class="text-danger">{{ $errors->first('artist_commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.artist_commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agent_commission">{{ trans('cruds.adminSetting.fields.agent_commission') }}</label>
                <input class="form-control {{ $errors->has('agent_commission') ? 'is-invalid' : '' }}" type="number" name="agent_commission" id="agent_commission" value="{{ old('agent_commission', '0') }}" step="1">
                @if($errors->has('agent_commission'))
                    <span class="text-danger">{{ $errors->first('agent_commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.agent_commission_helper') }}</span>
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