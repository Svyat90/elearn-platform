@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.settings.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.settings.update", [$setting->id]) }}" >
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="" for="title">{{ trans('cruds.settings.fields.val') }}</label>
                    <input class="form-control {{ $errors->has('val') ? 'is-invalid' : '' }}" type="text" name="val"
                           id="val" value="{{ old('val', $setting->val) }}" required>
                    @if($errors->has('val'))
                        <span class="text-danger">{{ $errors->first('val') }}</span>
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
