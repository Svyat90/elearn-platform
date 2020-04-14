@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.promoCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.promo-codes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="promo_code">{{ trans('cruds.promoCode.fields.promo_code') }}</label>
                <input class="form-control {{ $errors->has('promo_code') ? 'is-invalid' : '' }}" type="text" name="promo_code" id="promo_code" value="{{ old('promo_code', '') }}">
                @if($errors->has('promo_code'))
                    <span class="text-danger">{{ $errors->first('promo_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.promoCode.fields.promo_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount">{{ trans('cruds.promoCode.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', '') }}" step="0.01">
                @if($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.promoCode.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="minimum_order_value">{{ trans('cruds.promoCode.fields.minimum_order_value') }}</label>
                <input class="form-control {{ $errors->has('minimum_order_value') ? 'is-invalid' : '' }}" type="number" name="minimum_order_value" id="minimum_order_value" value="{{ old('minimum_order_value', '') }}" step="0.01">
                @if($errors->has('minimum_order_value'))
                    <span class="text-danger">{{ $errors->first('minimum_order_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.promoCode.fields.minimum_order_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.promoCode.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.promoCode.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.promoCode.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.promoCode.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="promotion_info">{{ trans('cruds.promoCode.fields.promotion_info') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('promotion_info') ? 'is-invalid' : '' }}" name="promotion_info" id="promotion_info">{!! old('promotion_info') !!}</textarea>
                @if($errors->has('promotion_info'))
                    <span class="text-danger">{{ $errors->first('promotion_info') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.promoCode.fields.promotion_info_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.promoCode.fields.status') }}</label>
                @foreach(App\PromoCode::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '1') === $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.promoCode.fields.status_helper') }}</span>
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
                xhr.open('POST', '/admin/promo-codes/ckmedia', true);
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
                data.append('crud_id', {{ $promoCode->id ?? 0 }});
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