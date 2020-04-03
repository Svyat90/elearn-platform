@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userReview.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-reviews.update", [$userReview->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="text">{{ trans('cruds.userReview.fields.text') }}</label>
                <input class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" type="text" name="text" id="text" value="{{ old('text', $userReview->text) }}" required>
                @if($errors->has('text'))
                    <span class="text-danger">{{ $errors->first('text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userReview.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stars">{{ trans('cruds.userReview.fields.stars') }}</label>
                <input class="form-control {{ $errors->has('stars') ? 'is-invalid' : '' }}" type="number" name="stars" id="stars" value="{{ old('stars', $userReview->stars) }}" step="1">
                @if($errors->has('stars'))
                    <span class="text-danger">{{ $errors->first('stars') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userReview.fields.stars_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_id">{{ trans('cruds.userReview.fields.video') }}</label>
                <select class="form-control select2 {{ $errors->has('video') ? 'is-invalid' : '' }}" name="video_id" id="video_id">
                    @foreach($videos as $id => $video)
                        <option value="{{ $id }}" {{ ($userReview->video ? $userReview->video->id : old('video_id')) == $id ? 'selected' : '' }}>{{ $video }}</option>
                    @endforeach
                </select>
                @if($errors->has('video'))
                    <span class="text-danger">{{ $errors->first('video') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userReview.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userReview.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($userReview->user ? $userReview->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userReview.fields.user_helper') }}</span>
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