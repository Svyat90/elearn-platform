@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userMetum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-meta.update", [$userMetum->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userMetum.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($userMetum->user ? $userMetum->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userMetum.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bio">{{ trans('cruds.userMetum.fields.bio') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('bio') ? 'is-invalid' : '' }}" name="bio" id="bio">{!! old('bio', $userMetum->bio) !!}</textarea>
                @if($errors->has('bio'))
                    <span class="text-danger">{{ $errors->first('bio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userMetum.fields.bio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_wishlist">{{ trans('cruds.userMetum.fields.user_wishlist') }}</label>
                <input class="form-control {{ $errors->has('user_wishlist') ? 'is-invalid' : '' }}" type="number" name="user_wishlist" id="user_wishlist" value="{{ old('user_wishlist', $userMetum->user_wishlist) }}" step="1">
                @if($errors->has('user_wishlist'))
                    <span class="text-danger">{{ $errors->first('user_wishlist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userMetum.fields.user_wishlist_helper') }}</span>
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
                xhr.open('POST', '/admin/user-meta/ckmedia', true);
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
                data.append('crud_id', {{ $userMetum->id ?? 0 }});
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