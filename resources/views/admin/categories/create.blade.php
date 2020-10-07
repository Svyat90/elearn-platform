@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.categories.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name_ru">{{ trans('cruds.category.fields.name') }}(ru)</label>
                    <input class="form-control {{ $errors->has('name_ru') ? 'is-invalid' : '' }}" type="text" name="name_ru"
                           id="name_ru" value="{{ old('name_ru', '') }}" required>
                    @if($errors->has('name_ru'))
                        <span class="text-danger">{{ $errors->first('name_ru') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name_ro">{{ trans('cruds.category.fields.name') }}(ro)</label>
                    <input class="form-control {{ $errors->has('name_ro') ? 'is-invalid' : '' }}" type="text" name="name_ro"
                           id="name_ro" value="{{ old('name_ro', '') }}" required>
                    @if($errors->has('name_ro'))
                        <span class="text-danger">{{ $errors->first('name_ro') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name_en">{{ trans('cruds.category.fields.name') }}(en)</label>
                    <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en"
                           id="name_en" value="{{ old('name_en', '') }}" required>
                    @if($errors->has('name_en'))
                        <span class="text-danger">{{ $errors->first('name_en') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="access">{{ trans('cruds.subCategory.fields.access') }}</label>
                    <select class="form-control select2 {{ $errors->has('access') ? 'is-invalid' : '' }}"
                            name="access" id="access" required>
                        @foreach($accessTypes as $access)
                            <option
                                value="{{ $access }}" {{ old('access', \App\Services\CategoryService::ACCESS_TYPE_PUBLIC) === $access ? 'selected' : '' }}>{{ $access }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('access'))
                        <span class="text-danger">{{ $errors->first('access') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.access_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="" for="role_ids">{{ trans('cruds.user.fields.access_roles') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('role_ids') ? 'is-invalid' : '' }}"
                            name="role_ids[]"
                            id="role_ids" multiple >
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ in_array($id, old('role_ids', [])) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('role_ids'))
                        <span class="text-danger">{{ $errors->first('role_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="" for="user_ids">{{ trans('cruds.user.fields.access_users') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('user_ids') ? 'is-invalid' : '' }}"
                            name="user_ids[]"
                            id="user_ids" multiple >
                        @foreach($users as $id => $user)
                            <option value="{{ $id }}" {{ in_array($id, old('user_ids', [])) ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user_ids'))
                        <span class="text-danger">{{ $errors->first('user_ids') }}</span>
                    @endif
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
