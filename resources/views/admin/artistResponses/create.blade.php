@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.artistResponse.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.artist-responses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="order_id">{{ trans('cruds.artistResponse.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $order)
                        <option value="{{ $id }}" {{ old('order_id') == $id ? 'selected' : '' }}>{{ $order }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <span class="text-danger">{{ $errors->first('order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.artistResponse.fields.artist_action') }}</label>
                <select class="form-control {{ $errors->has('artist_action') ? 'is-invalid' : '' }}" name="artist_action" id="artist_action">
                    <option value disabled {{ old('artist_action', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ArtistResponse::ARTIST_ACTION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('artist_action', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('artist_action'))
                    <span class="text-danger">{{ $errors->first('artist_action') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.artist_action_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.artistResponse.fields.video_status') }}</label>
                <select class="form-control {{ $errors->has('video_status') ? 'is-invalid' : '' }}" name="video_status" id="video_status">
                    <option value disabled {{ old('video_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ArtistResponse::VIDEO_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('video_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('video_status'))
                    <span class="text-danger">{{ $errors->first('video_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.video_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_id">{{ trans('cruds.artistResponse.fields.video') }}</label>
                <select class="form-control select2 {{ $errors->has('video') ? 'is-invalid' : '' }}" name="video_id" id="video_id">
                    @foreach($videos as $id => $video)
                        <option value="{{ $id }}" {{ old('video_id') == $id ? 'selected' : '' }}>{{ $video }}</option>
                    @endforeach
                </select>
                @if($errors->has('video'))
                    <span class="text-danger">{{ $errors->first('video') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_note">{{ trans('cruds.artistResponse.fields.artist_note') }}</label>
                <input class="form-control {{ $errors->has('artist_note') ? 'is-invalid' : '' }}" type="text" name="artist_note" id="artist_note" value="{{ old('artist_note', '') }}">
                @if($errors->has('artist_note'))
                    <span class="text-danger">{{ $errors->first('artist_note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.artist_note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="action_update">{{ trans('cruds.artistResponse.fields.action_update') }}</label>
                <input class="form-control datetime {{ $errors->has('action_update') ? 'is-invalid' : '' }}" type="text" name="action_update" id="action_update" value="{{ old('action_update') }}">
                @if($errors->has('action_update'))
                    <span class="text-danger">{{ $errors->first('action_update') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.action_update_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completion_update">{{ trans('cruds.artistResponse.fields.completion_update') }}</label>
                <input class="form-control datetime {{ $errors->has('completion_update') ? 'is-invalid' : '' }}" type="text" name="completion_update" id="completion_update" value="{{ old('completion_update') }}">
                @if($errors->has('completion_update'))
                    <span class="text-danger">{{ $errors->first('completion_update') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.completion_update_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_id">{{ trans('cruds.artistResponse.fields.artist') }}</label>
                <select class="form-control select2 {{ $errors->has('artist') ? 'is-invalid' : '' }}" name="artist_id" id="artist_id">
                    @foreach($artists as $id => $artist)
                        <option value="{{ $id }}" {{ old('artist_id') == $id ? 'selected' : '' }}>{{ $artist }}</option>
                    @endforeach
                </select>
                @if($errors->has('artist'))
                    <span class="text-danger">{{ $errors->first('artist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistResponse.fields.artist_helper') }}</span>
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