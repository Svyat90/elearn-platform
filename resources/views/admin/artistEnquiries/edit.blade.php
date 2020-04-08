@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.artistEnquiry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.artist-enquiries.update", [$artistEnquiry->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="artist_id">{{ trans('cruds.artistEnquiry.fields.artist') }}</label>
                <select class="form-control select2 {{ $errors->has('artist') ? 'is-invalid' : '' }}" name="artist_id" id="artist_id">
                    @foreach($artists as $id => $artist)
                        <option value="{{ $id }}" {{ ($artistEnquiry->artist ? $artistEnquiry->artist->id : old('artist_id')) == $id ? 'selected' : '' }}>{{ $artist }}</option>
                    @endforeach
                </select>
                @if($errors->has('artist'))
                    <span class="text-danger">{{ $errors->first('artist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.artist_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.artistEnquiry.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $artistEnquiry->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.artistEnquiry.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $artistEnquiry->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_no">{{ trans('cruds.artistEnquiry.fields.contact_no') }}</label>
                <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="text" name="contact_no" id="contact_no" value="{{ old('contact_no', $artistEnquiry->contact_no) }}">
                @if($errors->has('contact_no'))
                    <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.contact_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_media_type">{{ trans('cruds.artistEnquiry.fields.social_media_type') }}</label>
                <input class="form-control {{ $errors->has('social_media_type') ? 'is-invalid' : '' }}" type="text" name="social_media_type" id="social_media_type" value="{{ old('social_media_type', $artistEnquiry->social_media_type) }}">
                @if($errors->has('social_media_type'))
                    <span class="text-danger">{{ $errors->first('social_media_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.social_media_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_media">{{ trans('cruds.artistEnquiry.fields.social_media') }}</label>
                <input class="form-control {{ $errors->has('social_media') ? 'is-invalid' : '' }}" type="text" name="social_media" id="social_media" value="{{ old('social_media', $artistEnquiry->social_media) }}">
                @if($errors->has('social_media'))
                    <span class="text-danger">{{ $errors->first('social_media') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.social_media_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_media_followrs">{{ trans('cruds.artistEnquiry.fields.social_media_followrs') }}</label>
                <input class="form-control {{ $errors->has('social_media_followrs') ? 'is-invalid' : '' }}" type="number" name="social_media_followrs" id="social_media_followrs" value="{{ old('social_media_followrs', $artistEnquiry->social_media_followrs) }}" step="1">
                @if($errors->has('social_media_followrs'))
                    <span class="text-danger">{{ $errors->first('social_media_followrs') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.social_media_followrs_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country_id">{{ trans('cruds.artistEnquiry.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id">
                    @foreach($countries as $id => $country)
                        <option value="{{ $id }}" {{ ($artistEnquiry->country ? $artistEnquiry->country->id : old('country_id')) == $id ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.artistEnquiry.fields.note') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{!! old('note', $artistEnquiry->note) !!}</textarea>
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.artistEnquiry.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ArtistEnquiry::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $artistEnquiry->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistEnquiry.fields.status_helper') }}</span>
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
                xhr.open('POST', '/admin/artist-enquiries/ckmedia', true);
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
                data.append('crud_id', {{ $artistEnquiry->id ?? 0 }});
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