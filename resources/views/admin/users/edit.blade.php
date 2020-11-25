@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]"
                            id="roles" multiple required>
                        @foreach($roles as $id => $roles)
                            <option
                                value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('roles'))
                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="" for="first_name">{{ trans('cruds.user.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text"
                           name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}">
                    @if($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                           name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}">
                    @if($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="position">{{ trans('cruds.user.fields.position') }}</label>
                    <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text"
                           name="position" id="position" value="{{ old('position', $user->position) }}">
                    @if($errors->has('position'))
                        <span class="text-danger">{{ $errors->first('position') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="institution">{{ trans('cruds.user.fields.institution') }}</label>
                    <input class="form-control {{ $errors->has('institution') ? 'is-invalid' : '' }}" type="text"
                           name="institution" id="institution" value="{{ old('institution', $user->institution) }}">
                    @if($errors->has('institution'))
                        <span class="text-danger">{{ $errors->first('institution') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                           id="phone" value="{{ old('phone', $user->phone) }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                           name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                           name="password" id="password">
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.user.fields.user_status') }}</label>
                    <select class="form-control {{ $errors->has('user_status') ? 'is-invalid' : '' }}"
                            name="user_status" id="user_status">
                        <option value
                                disabled {{ old('user_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\User::USER_STATUS_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('user_status', $user->user_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user_status'))
                        <span class="text-danger">{{ $errors->first('user_status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.user_status_helper') }}</span>
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
