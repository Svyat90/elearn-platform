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
                <label for="mobile_no">{{ trans('cruds.user.fields.mobile_no') }}</label>
                <input class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}">
                @if($errors->has('mobile_no'))
                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.mobile_no_helper') }}</span>
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
                <label for="gender_id">{{ trans('cruds.user.fields.gender') }}</label>
                <select class="form-control select2 {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender_id" id="gender_id">
                    @foreach($genders as $id => $gender)
                        <option value="{{ $id }}" {{ ($user->gender ? $user->gender->id : old('gender_id')) == $id ? 'selected' : '' }}>{{ $gender }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referral_code">{{ trans('cruds.user.fields.referral_code') }}</label>
                <input class="form-control {{ $errors->has('referral_code') ? 'is-invalid' : '' }}" type="text" name="referral_code" id="referral_code" value="{{ old('referral_code', $user->referral_code) }}">
                @if($errors->has('referral_code'))
                    <span class="text-danger">{{ $errors->first('referral_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.referral_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referred_by">{{ trans('cruds.user.fields.referred_by') }}</label>
                <input class="form-control {{ $errors->has('referred_by') ? 'is-invalid' : '' }}" type="text" name="referred_by" id="referred_by" value="{{ old('referred_by', $user->referred_by) }}">
                @if($errors->has('referred_by'))
                    <span class="text-danger">{{ $errors->first('referred_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.referred_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.registration_platform') }}</label>
                <select class="form-control {{ $errors->has('registration_platform') ? 'is-invalid' : '' }}" name="registration_platform" id="registration_platform">
                    <option value disabled {{ old('registration_platform', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\User::REGISTRATION_PLATFORM_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('registration_platform', $user->registration_platform) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('registration_platform'))
                    <span class="text-danger">{{ $errors->first('registration_platform') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.registration_platform_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ig_token">{{ trans('cruds.user.fields.ig_token') }}</label>
                <input class="form-control {{ $errors->has('ig_token') ? 'is-invalid' : '' }}" type="text" name="ig_token" id="ig_token" value="{{ old('ig_token', $user->ig_token) }}">
                @if($errors->has('ig_token'))
                    <span class="text-danger">{{ $errors->first('ig_token') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.ig_token_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ig_username">{{ trans('cruds.user.fields.ig_username') }}</label>
                <input class="form-control {{ $errors->has('ig_username') ? 'is-invalid' : '' }}" type="text" name="ig_username" id="ig_username" value="{{ old('ig_username', $user->ig_username) }}">
                @if($errors->has('ig_username'))
                    <span class="text-danger">{{ $errors->first('ig_username') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.ig_username_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.user_status') }}</label>
                <select class="form-control {{ $errors->has('user_status') ? 'is-invalid' : '' }}" name="user_status" id="user_status">
                    <option value disabled {{ old('user_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\User::USER_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('user_status', $user->user_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_status'))
                    <span class="text-danger">{{ $errors->first('user_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.user_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birth_date">{{ trans('cruds.user.fields.birth_date') }}</label>
                <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date', $user->birth_date) }}">
                @if($errors->has('birth_date'))
                    <span class="text-danger">{{ $errors->first('birth_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.birth_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="avatar">{{ trans('cruds.user.fields.avatar') }}</label>
                <div class="needsclick dropzone {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="avatar-dropzone">
                </div>
                @if($errors->has('avatar'))
                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.user.fields.registration_source') }}</label>
                <select class="form-control {{ $errors->has('registration_source') ? 'is-invalid' : '' }}" name="registration_source" id="registration_source">
                    <option value disabled {{ old('registration_source', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\User::REGISTRATION_SOURCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('registration_source', $user->registration_source) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('registration_source'))
                    <span class="text-danger">{{ $errors->first('registration_source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.registration_source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="registered_on">{{ trans('cruds.user.fields.registered_on') }}</label>
                <input class="form-control datetime {{ $errors->has('registered_on') ? 'is-invalid' : '' }}" type="text" name="registered_on" id="registered_on" value="{{ old('registered_on', $user->registered_on) }}">
                @if($errors->has('registered_on'))
                    <span class="text-danger">{{ $errors->first('registered_on') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.registered_on_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.avatarDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 12, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 12,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="avatar"]').remove()
      $('form').append('<input type="hidden" name="avatar" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="avatar"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->avatar)
      var file = {!! json_encode($user->avatar) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $user->avatar->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="avatar" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection