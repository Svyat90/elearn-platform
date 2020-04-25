@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pageSeo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.page-seos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="page_url">{{ trans('cruds.pageSeo.fields.page_url') }}</label>
                <input class="form-control {{ $errors->has('page_url') ? 'is-invalid' : '' }}" type="text" name="page_url" id="page_url" value="{{ old('page_url', '') }}">
                @if($errors->has('page_url'))
                    <span class="text-danger">{{ $errors->first('page_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pageSeo.fields.page_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="meta_title">{{ trans('cruds.pageSeo.fields.meta_title') }}</label>
                <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', '') }}" required>
                @if($errors->has('meta_title'))
                    <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pageSeo.fields.meta_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meta_description">{{ trans('cruds.pageSeo.fields.meta_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description">{!! old('meta_description') !!}</textarea>
                @if($errors->has('meta_description'))
                    <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pageSeo.fields.meta_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meta_keywords">{{ trans('cruds.pageSeo.fields.meta_keywords') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" name="meta_keywords" id="meta_keywords">{!! old('meta_keywords') !!}</textarea>
                @if($errors->has('meta_keywords'))
                    <span class="text-danger">{{ $errors->first('meta_keywords') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pageSeo.fields.meta_keywords_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_image_url">{{ trans('cruds.pageSeo.fields.social_image_url') }}</label>
                <div class="needsclick dropzone {{ $errors->has('social_image_url') ? 'is-invalid' : '' }}" id="social_image_url-dropzone">
                </div>
                @if($errors->has('social_image_url'))
                    <span class="text-danger">{{ $errors->first('social_image_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pageSeo.fields.social_image_url_helper') }}</span>
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
                xhr.open('POST', '/admin/page-seos/ckmedia', true);
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
                data.append('crud_id', {{ $pageSeo->id ?? 0 }});
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
    Dropzone.options.socialImageUrlDropzone = {
    url: '{{ route('admin.page-seos.storeMedia') }}',
    maxFilesize: 20000, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20000,
      width: 8096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="social_image_url"]').remove()
      $('form').append('<input type="hidden" name="social_image_url" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="social_image_url"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pageSeo) && $pageSeo->social_image_url)
      var file = {!! json_encode($pageSeo->social_image_url) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $pageSeo->social_image_url->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="social_image_url" value="' + file.file_name + '">')
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