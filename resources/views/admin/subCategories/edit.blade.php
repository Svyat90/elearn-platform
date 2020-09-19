@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.subCategory.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.sub-categories.update", [$subCategory->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name_ru">{{ trans('cruds.subCategory.fields.name') }}(ru)</label>
                    <input class="form-control {{ $errors->has('name_ru') ? 'is-invalid' : '' }}" type="text" name="name_ru"
                           id="name_ru" value="{{ old('name_ru', $subCategory->name_ru) }}" required>
                    @if($errors->has('name_ru'))
                        <span class="text-danger">{{ $errors->first('name_ru') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subCategory.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name_ro">{{ trans('cruds.subCategory.fields.name') }}(ro)</label>
                    <input class="form-control {{ $errors->has('name_ro') ? 'is-invalid' : '' }}" type="text" name="name_ro"
                           id="name_ro" value="{{ old('name_ro', $subCategory->name_ro) }}" required>
                    @if($errors->has('name_ro'))
                        <span class="text-danger">{{ $errors->first('name_ro') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subCategory.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name_en">{{ trans('cruds.subCategory.fields.name') }}(en)</label>
                    <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en"
                           id="name_en" value="{{ old('name_en', $subCategory->name_en) }}" required>
                    @if($errors->has('name_en'))
                        <span class="text-danger">{{ $errors->first('name_en') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subCategory.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="parent_id">{{ trans('cruds.subCategory.fields.parent') }}</label>
                    <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}"
                            name="parent_id" id="parent_id" required>
                        @foreach($parents as $id => $parent)
                            <option
                                value="{{ $id }}" {{ ($subCategory->parent ? $subCategory->parent->id : old('parent_id')) == $id ? 'selected' : '' }}>{{ $parent }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('parent'))
                        <span class="text-danger">{{ $errors->first('parent') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subCategory.fields.parent_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="access">{{ trans('cruds.subCategory.fields.access') }}</label>
                    <select class="form-control select2 {{ $errors->has('access') ? 'is-invalid' : '' }}"
                            name="access" id="access" required>
                        @foreach($accessTypes as $access)
                            <option
                                value="{{ $access }}" {{ old('access', $subCategory->access) === $access ? 'selected' : '' }}>{{ $access }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('access'))
                        <span class="text-danger">{{ $errors->first('access') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subCategory.fields.access_helper') }}</span>
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
