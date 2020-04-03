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
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <span class="text-danger">{{ $errors->first('roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.user.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}">
                @if($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dob">{{ trans('cruds.user.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $user->dob) }}">
                @if($errors->has('dob'))
                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="position_occupation">{{ trans('cruds.user.fields.position_occupation') }}</label>
                <input class="form-control {{ $errors->has('position_occupation') ? 'is-invalid' : '' }}" type="text" name="position_occupation" id="position_occupation" value="{{ old('position_occupation', $user->position_occupation) }}">
                @if($errors->has('position_occupation'))
                    <span class="text-danger">{{ $errors->first('position_occupation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.position_occupation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subscribers">{{ trans('cruds.user.fields.subscribers') }}</label>
                <input class="form-control {{ $errors->has('subscribers') ? 'is-invalid' : '' }}" type="number" name="subscribers" id="subscribers" value="{{ old('subscribers', $user->subscribers) }}" step="1">
                @if($errors->has('subscribers'))
                    <span class="text-danger">{{ $errors->first('subscribers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.subscribers_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bio">{{ trans('cruds.user.fields.bio') }}</label>
                <input class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}" type="text" name="bio" id="bio" value="{{ old('bio', $user->bio) }}">
                @if($errors->has('bio'))
                    <span class="text-danger">{{ $errors->first('bio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.bio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="languages">{{ trans('cruds.user.fields.language') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('languages') ? 'is-invalid' : '' }}" name="languages[]" id="languages" multiple>
                    @foreach($languages as $id => $language)
                        <option value="{{ $id }}" {{ (in_array($id, old('languages', [])) || $user->languages->contains($id)) ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                </select>
                @if($errors->has('languages'))
                    <span class="text-danger">{{ $errors->first('languages') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country_id">{{ trans('cruds.user.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id">
                    @foreach($countries as $id => $country)
                        <option value="{{ $id }}" {{ ($user->country ? $user->country->id : old('country_id')) == $id ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_meidias">{{ trans('cruds.user.fields.social_meidia') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('social_meidias') ? 'is-invalid' : '' }}" name="social_meidias[]" id="social_meidias" multiple>
                    @foreach($social_meidias as $id => $social_meidia)
                        <option value="{{ $id }}" {{ (in_array($id, old('social_meidias', [])) || $user->social_meidias->contains($id)) ? 'selected' : '' }}>{{ $social_meidia }}</option>
                    @endforeach
                </select>
                @if($errors->has('social_meidias'))
                    <span class="text-danger">{{ $errors->first('social_meidias') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.social_meidia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.user.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $user->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.category_helper') }}</span>
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