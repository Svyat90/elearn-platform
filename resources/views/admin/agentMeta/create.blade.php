@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.agentMetum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.agent-meta.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.agentMetum.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agentMetum.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agent_commission">{{ trans('cruds.agentMetum.fields.agent_commission') }}</label>
                <input class="form-control {{ $errors->has('agent_commission') ? 'is-invalid' : '' }}" type="number" name="agent_commission" id="agent_commission" value="{{ old('agent_commission', '') }}" step="0.01">
                @if($errors->has('agent_commission'))
                    <span class="text-danger">{{ $errors->first('agent_commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agentMetum.fields.agent_commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.agentMetum.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}">
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agentMetum.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.agentMetum.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agentMetum.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agent_status">{{ trans('cruds.agentMetum.fields.agent_status') }}</label>
                <input class="form-control {{ $errors->has('agent_status') ? 'is-invalid' : '' }}" type="text" name="agent_status" id="agent_status" value="{{ old('agent_status', '') }}">
                @if($errors->has('agent_status'))
                    <span class="text-danger">{{ $errors->first('agent_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agentMetum.fields.agent_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="registered_on">{{ trans('cruds.agentMetum.fields.registered_on') }}</label>
                <input class="form-control date {{ $errors->has('registered_on') ? 'is-invalid' : '' }}" type="text" name="registered_on" id="registered_on" value="{{ old('registered_on') }}">
                @if($errors->has('registered_on'))
                    <span class="text-danger">{{ $errors->first('registered_on') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agentMetum.fields.registered_on_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agent_id">{{ trans('cruds.agentMetum.fields.agent') }}</label>
                <select class="form-control select2 {{ $errors->has('agent') ? 'is-invalid' : '' }}" name="agent_id" id="agent_id">
                    @foreach($agents as $id => $agent)
                        <option value="{{ $id }}" {{ old('agent_id') == $id ? 'selected' : '' }}>{{ $agent }}</option>
                    @endforeach
                </select>
                @if($errors->has('agent'))
                    <span class="text-danger">{{ $errors->first('agent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agentMetum.fields.agent_helper') }}</span>
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