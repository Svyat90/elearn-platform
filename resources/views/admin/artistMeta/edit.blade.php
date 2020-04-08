@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.artistMetum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.artist-meta.update", [$artistMetum->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="artist_id">{{ trans('cruds.artistMetum.fields.artist') }}</label>
                <select class="form-control select2 {{ $errors->has('artist') ? 'is-invalid' : '' }}" name="artist_id" id="artist_id">
                    @foreach($artists as $id => $artist)
                        <option value="{{ $id }}" {{ ($artistMetum->artist ? $artistMetum->artist->id : old('artist_id')) == $id ? 'selected' : '' }}>{{ $artist }}</option>
                    @endforeach
                </select>
                @if($errors->has('artist'))
                    <span class="text-danger">{{ $errors->first('artist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.artist_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="display_name">{{ trans('cruds.artistMetum.fields.display_name') }}</label>
                <input class="form-control {{ $errors->has('display_name') ? 'is-invalid' : '' }}" type="text" name="display_name" id="display_name" value="{{ old('display_name', $artistMetum->display_name) }}">
                @if($errors->has('display_name'))
                    <span class="text-danger">{{ $errors->first('display_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.display_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profile_info">{{ trans('cruds.artistMetum.fields.profile_info') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('profile_info') ? 'is-invalid' : '' }}" name="profile_info" id="profile_info">{!! old('profile_info', $artistMetum->profile_info) !!}</textarea>
                @if($errors->has('profile_info'))
                    <span class="text-danger">{{ $errors->first('profile_info') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.profile_info_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="languages">{{ trans('cruds.artistMetum.fields.languages') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('languages') ? 'is-invalid' : '' }}" name="languages[]" id="languages" multiple>
                    @foreach($languages as $id => $languages)
                        <option value="{{ $id }}" {{ (in_array($id, old('languages', [])) || $artistMetum->languages->contains($id)) ? 'selected' : '' }}>{{ $languages }}</option>
                    @endforeach
                </select>
                @if($errors->has('languages'))
                    <span class="text-danger">{{ $errors->first('languages') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.languages_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_catogery_id">{{ trans('cruds.artistMetum.fields.main_catogery') }}</label>
                <select class="form-control select2 {{ $errors->has('main_catogery') ? 'is-invalid' : '' }}" name="main_catogery_id" id="main_catogery_id">
                    @foreach($main_catogeries as $id => $main_catogery)
                        <option value="{{ $id }}" {{ ($artistMetum->main_catogery ? $artistMetum->main_catogery->id : old('main_catogery_id')) == $id ? 'selected' : '' }}>{{ $main_catogery }}</option>
                    @endforeach
                </select>
                @if($errors->has('main_catogery'))
                    <span class="text-danger">{{ $errors->first('main_catogery') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.main_catogery_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sub_category_id">{{ trans('cruds.artistMetum.fields.sub_category') }}</label>
                <select class="form-control select2 {{ $errors->has('sub_category') ? 'is-invalid' : '' }}" name="sub_category_id" id="sub_category_id">
                    @foreach($sub_categories as $id => $sub_category)
                        <option value="{{ $id }}" {{ ($artistMetum->sub_category ? $artistMetum->sub_category->id : old('sub_category_id')) == $id ? 'selected' : '' }}>{{ $sub_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('sub_category'))
                    <span class="text-danger">{{ $errors->first('sub_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.sub_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.artistMetum.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tags)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $artistMetum->tags->contains($id)) ? 'selected' : '' }}>{{ $tags }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_fee">{{ trans('cruds.artistMetum.fields.artist_fee') }}</label>
                <input class="form-control {{ $errors->has('artist_fee') ? 'is-invalid' : '' }}" type="number" name="artist_fee" id="artist_fee" value="{{ old('artist_fee', $artistMetum->artist_fee) }}" step="0.01">
                @if($errors->has('artist_fee'))
                    <span class="text-danger">{{ $errors->first('artist_fee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.artist_fee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_commission">{{ trans('cruds.artistMetum.fields.artist_commission') }}</label>
                <input class="form-control {{ $errors->has('artist_commission') ? 'is-invalid' : '' }}" type="number" name="artist_commission" id="artist_commission" value="{{ old('artist_commission', $artistMetum->artist_commission) }}" step="0.01">
                @if($errors->has('artist_commission'))
                    <span class="text-danger">{{ $errors->first('artist_commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.artist_commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_commission">{{ trans('cruds.artistMetum.fields.company_commission') }}</label>
                <input class="form-control {{ $errors->has('company_commission') ? 'is-invalid' : '' }}" type="number" name="company_commission" id="company_commission" value="{{ old('company_commission', $artistMetum->company_commission) }}" step="0.01">
                @if($errors->has('company_commission'))
                    <span class="text-danger">{{ $errors->first('company_commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.company_commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_status_email">{{ trans('cruds.artistMetum.fields.order_status_email') }}</label>
                <input class="form-control {{ $errors->has('order_status_email') ? 'is-invalid' : '' }}" type="text" name="order_status_email" id="order_status_email" value="{{ old('order_status_email', $artistMetum->order_status_email) }}">
                @if($errors->has('order_status_email'))
                    <span class="text-danger">{{ $errors->first('order_status_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.order_status_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profile_photo_url">{{ trans('cruds.artistMetum.fields.profile_photo_url') }}</label>
                <div class="needsclick dropzone {{ $errors->has('profile_photo_url') ? 'is-invalid' : '' }}" id="profile_photo_url-dropzone">
                </div>
                @if($errors->has('profile_photo_url'))
                    <span class="text-danger">{{ $errors->first('profile_photo_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.profile_photo_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="intro_video_url">{{ trans('cruds.artistMetum.fields.intro_video_url') }}</label>
                <div class="needsclick dropzone {{ $errors->has('intro_video_url') ? 'is-invalid' : '' }}" id="intro_video_url-dropzone">
                </div>
                @if($errors->has('intro_video_url'))
                    <span class="text-danger">{{ $errors->first('intro_video_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.intro_video_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_name">{{ trans('cruds.artistMetum.fields.url_name') }}</label>
                <input class="form-control {{ $errors->has('url_name') ? 'is-invalid' : '' }}" type="text" name="url_name" id="url_name" value="{{ old('url_name', $artistMetum->url_name) }}">
                @if($errors->has('url_name'))
                    <span class="text-danger">{{ $errors->first('url_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.url_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_instagram">{{ trans('cruds.artistMetum.fields.social_instagram') }}</label>
                <input class="form-control {{ $errors->has('social_instagram') ? 'is-invalid' : '' }}" type="text" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $artistMetum->social_instagram) }}">
                @if($errors->has('social_instagram'))
                    <span class="text-danger">{{ $errors->first('social_instagram') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_instagram_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_facebook">{{ trans('cruds.artistMetum.fields.social_facebook') }}</label>
                <input class="form-control {{ $errors->has('social_facebook') ? 'is-invalid' : '' }}" type="text" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $artistMetum->social_facebook) }}">
                @if($errors->has('social_facebook'))
                    <span class="text-danger">{{ $errors->first('social_facebook') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_facebook_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_youtube">{{ trans('cruds.artistMetum.fields.social_youtube') }}</label>
                <input class="form-control {{ $errors->has('social_youtube') ? 'is-invalid' : '' }}" type="text" name="social_youtube" id="social_youtube" value="{{ old('social_youtube', $artistMetum->social_youtube) }}">
                @if($errors->has('social_youtube'))
                    <span class="text-danger">{{ $errors->first('social_youtube') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_youtube_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_tiktok">{{ trans('cruds.artistMetum.fields.social_tiktok') }}</label>
                <input class="form-control {{ $errors->has('social_tiktok') ? 'is-invalid' : '' }}" type="text" name="social_tiktok" id="social_tiktok" value="{{ old('social_tiktok', $artistMetum->social_tiktok) }}">
                @if($errors->has('social_tiktok'))
                    <span class="text-danger">{{ $errors->first('social_tiktok') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_tiktok_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_snapchat">{{ trans('cruds.artistMetum.fields.social_snapchat') }}</label>
                <input class="form-control {{ $errors->has('social_snapchat') ? 'is-invalid' : '' }}" type="text" name="social_snapchat" id="social_snapchat" value="{{ old('social_snapchat', $artistMetum->social_snapchat) }}">
                @if($errors->has('social_snapchat'))
                    <span class="text-danger">{{ $errors->first('social_snapchat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_snapchat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_twitter">{{ trans('cruds.artistMetum.fields.social_twitter') }}</label>
                <input class="form-control {{ $errors->has('social_twitter') ? 'is-invalid' : '' }}" type="text" name="social_twitter" id="social_twitter" value="{{ old('social_twitter', $artistMetum->social_twitter) }}">
                @if($errors->has('social_twitter'))
                    <span class="text-danger">{{ $errors->first('social_twitter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_twitter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_twitch">{{ trans('cruds.artistMetum.fields.social_twitch') }}</label>
                <input class="form-control {{ $errors->has('social_twitch') ? 'is-invalid' : '' }}" type="text" name="social_twitch" id="social_twitch" value="{{ old('social_twitch', $artistMetum->social_twitch) }}">
                @if($errors->has('social_twitch'))
                    <span class="text-danger">{{ $errors->first('social_twitch') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_twitch_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_linkedin">{{ trans('cruds.artistMetum.fields.social_linkedin') }}</label>
                <input class="form-control {{ $errors->has('social_linkedin') ? 'is-invalid' : '' }}" type="text" name="social_linkedin" id="social_linkedin" value="{{ old('social_linkedin', $artistMetum->social_linkedin) }}">
                @if($errors->has('social_linkedin'))
                    <span class="text-danger">{{ $errors->first('social_linkedin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.social_linkedin_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.artistMetum.fields.artist_status') }}</label>
                <select class="form-control {{ $errors->has('artist_status') ? 'is-invalid' : '' }}" name="artist_status" id="artist_status">
                    <option value disabled {{ old('artist_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ArtistMetum::ARTIST_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('artist_status', $artistMetum->artist_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('artist_status'))
                    <span class="text-danger">{{ $errors->first('artist_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistMetum.fields.artist_status_helper') }}</span>
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
                xhr.open('POST', '/admin/artist-meta/ckmedia', true);
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
                data.append('crud_id', {{ $artistMetum->id ?? 0 }});
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

<script>
    Dropzone.options.profilePhotoUrlDropzone = {
    url: '{{ route('admin.artist-meta.storeMedia') }}',
    maxFilesize: 12, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 12,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="profile_photo_url"]').remove()
      $('form').append('<input type="hidden" name="profile_photo_url" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="profile_photo_url"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($artistMetum) && $artistMetum->profile_photo_url)
      var file = {!! json_encode($artistMetum->profile_photo_url) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $artistMetum->profile_photo_url->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="profile_photo_url" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.introVideoUrlDropzone = {
    url: '{{ route('admin.artist-meta.storeMedia') }}',
    maxFilesize: 100, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100
    },
    success: function (file, response) {
      $('form').find('input[name="intro_video_url"]').remove()
      $('form').append('<input type="hidden" name="intro_video_url" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="intro_video_url"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($artistMetum) && $artistMetum->intro_video_url)
      var file = {!! json_encode($artistMetum->intro_video_url) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="intro_video_url" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection