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
                <label for="review_text">{{ trans('cruds.userReview.fields.review_text') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('review_text') ? 'is-invalid' : '' }}" name="review_text" id="review_text">{!! old('review_text', $userReview->review_text) !!}</textarea>
                @if($errors->has('review_text'))
                    <span class="text-danger">{{ $errors->first('review_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userReview.fields.review_text_helper') }}</span>
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
                <label>{{ trans('cruds.userReview.fields.show_video') }}</label>
                @foreach(App\UserReview::SHOW_VIDEO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('show_video') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="show_video_{{ $key }}" name="show_video" value="{{ $key }}" {{ old('show_video', $userReview->show_video) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_video_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('show_video'))
                    <span class="text-danger">{{ $errors->first('show_video') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userReview.fields.show_video_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.userReview.fields.review_apporval') }}</label>
                <select class="form-control {{ $errors->has('review_apporval') ? 'is-invalid' : '' }}" name="review_apporval" id="review_apporval">
                    <option value disabled {{ old('review_apporval', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\UserReview::REVIEW_APPORVAL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('review_apporval', $userReview->review_apporval) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('review_apporval'))
                    <span class="text-danger">{{ $errors->first('review_apporval') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userReview.fields.review_apporval_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/user-reviews/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $userReview->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection