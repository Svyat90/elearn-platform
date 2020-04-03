@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.orderHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-histories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.orderHistory.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderHistory.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="videos">{{ trans('cruds.orderHistory.fields.video') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('videos') ? 'is-invalid' : '' }}" name="videos[]" id="videos" multiple>
                    @foreach($videos as $id => $video)
                        <option value="{{ $id }}" {{ in_array($id, old('videos', [])) ? 'selected' : '' }}>{{ $video }}</option>
                    @endforeach
                </select>
                @if($errors->has('videos'))
                    <span class="text-danger">{{ $errors->first('videos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderHistory.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.orderHistory.fields.comment') }}</label>
                <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment" id="comment" value="{{ old('comment', '') }}">
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderHistory.fields.comment_helper') }}</span>
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