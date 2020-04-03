@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.searchLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.search-logs.update", [$searchLog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="term">{{ trans('cruds.searchLog.fields.term') }}</label>
                <input class="form-control {{ $errors->has('term') ? 'is-invalid' : '' }}" type="text" name="term" id="term" value="{{ old('term', $searchLog->term) }}">
                @if($errors->has('term'))
                    <span class="text-danger">{{ $errors->first('term') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.searchLog.fields.term_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page">{{ trans('cruds.searchLog.fields.page') }}</label>
                <input class="form-control {{ $errors->has('page') ? 'is-invalid' : '' }}" type="text" name="page" id="page" value="{{ old('page', $searchLog->page) }}">
                @if($errors->has('page'))
                    <span class="text-danger">{{ $errors->first('page') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.searchLog.fields.page_helper') }}</span>
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