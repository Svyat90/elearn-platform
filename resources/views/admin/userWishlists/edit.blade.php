@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userWishlist.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-wishlists.update", [$userWishlist->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userWishlist.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($userWishlist->user ? $userWishlist->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWishlist.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_id">{{ trans('cruds.userWishlist.fields.artist') }}</label>
                <select class="form-control select2 {{ $errors->has('artist') ? 'is-invalid' : '' }}" name="artist_id" id="artist_id">
                    @foreach($artists as $id => $artist)
                        <option value="{{ $id }}" {{ ($userWishlist->artist ? $userWishlist->artist->id : old('artist_id')) == $id ? 'selected' : '' }}>{{ $artist }}</option>
                    @endforeach
                </select>
                @if($errors->has('artist'))
                    <span class="text-danger">{{ $errors->first('artist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWishlist.fields.artist_helper') }}</span>
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