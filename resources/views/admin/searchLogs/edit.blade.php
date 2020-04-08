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
                <label for="search_term">{{ trans('cruds.searchLog.fields.search_term') }}</label>
                <input class="form-control {{ $errors->has('search_term') ? 'is-invalid' : '' }}" type="text" name="search_term" id="search_term" value="{{ old('search_term', $searchLog->search_term) }}">
                @if($errors->has('search_term'))
                    <span class="text-danger">{{ $errors->first('search_term') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.searchLog.fields.search_term_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.searchLog.fields.search_from') }}</label>
                <select class="form-control {{ $errors->has('search_from') ? 'is-invalid' : '' }}" name="search_from" id="search_from">
                    <option value disabled {{ old('search_from', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\SearchLog::SEARCH_FROM_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('search_from', $searchLog->search_from) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('search_from'))
                    <span class="text-danger">{{ $errors->first('search_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.searchLog.fields.search_from_helper') }}</span>
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