@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.course.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.courses.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_ru">{{ trans('cruds.course.fields.name') }} (ru)</label>
                        <input class="form-control {{ $errors->has('name_ru') ? 'is-invalid' : '' }}" type="text"
                               name="name_ru"
                               id="name_ru" value="{{ old('name_ru', '') }}">
                        @if($errors->has('name_ru'))
                            <span class="text-danger">{{ $errors->first('name_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_ro">{{ trans('cruds.course.fields.name') }} (ro)</label>
                        <input class="form-control {{ $errors->has('name_ro') ? 'is-invalid' : '' }}" type="text"
                               name="name_ro"
                               id="name_ro" value="{{ old('name_ro', '') }}">
                        @if($errors->has('name_ro'))
                            <span class="text-danger">{{ $errors->first('name_ro') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_en">{{ trans('cruds.course.fields.name') }} (en)</label>
                        <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text"
                               name="name_en"
                               id="name_en" value="{{ old('name_en', '') }}">
                        @if($errors->has('name_en'))
                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.name_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_issuer_ru">{{ trans('cruds.course.fields.name_issuer') }}
                            (ru)</label>
                        <input class="form-control {{ $errors->has('name_issuer_ru') ? 'is-invalid' : '' }}" type="text"
                               name="name_issuer_ru"
                               id="name_issuer_ru" value="{{ old('name_issuer_ru', '') }}">
                        @if($errors->has('name_issuer_ru'))
                            <span class="text-danger">{{ $errors->first('name_issuer_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.name_issuer_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_issuer_ro">{{ trans('cruds.course.fields.name_issuer') }}
                            (ro)</label>
                        <input class="form-control {{ $errors->has('name_issuer_ro') ? 'is-invalid' : '' }}" type="text"
                               name="name_issuer_ro"
                               id="name_issuer_ro" value="{{ old('name_issuer_ro', '') }}">
                        @if($errors->has('name_issuer_ro'))
                            <span class="text-danger">{{ $errors->first('name_issuer_ro') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.name_issuer_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_issuer_en">{{ trans('cruds.course.fields.name_issuer') }}
                            (en)</label>
                        <input class="form-control {{ $errors->has('name_issuer_en') ? 'is-invalid' : '' }}" type="text"
                               name="name_issuer_en"
                               id="name_issuer_en" value="{{ old('name_issuer_en', '') }}">
                        @if($errors->has('name_issuer_en'))
                            <span class="text-danger">{{ $errors->first('name_issuer_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.name_issuer_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="topic_ru">{{ trans('cruds.course.fields.topic') }}(ru)</label>
                        <input class="form-control {{ $errors->has('topic_ru') ? 'is-invalid' : '' }}" type="text"
                               name="topic_ru"
                               id="topic_ru" value="{{ old('topic_ru', '') }}">
                        @if($errors->has('topic_ru'))
                            <span class="text-danger">{{ $errors->first('topic_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.topic_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="topic_ro">{{ trans('cruds.course.fields.topic') }}(ro)</label>
                        <input class="form-control {{ $errors->has('topic_ro') ? 'is-invalid' : '' }}" type="text"
                               name="topic_ro"
                               id="topic_ro" value="{{ old('topic_ro', '') }}">
                        @if($errors->has('topic_ro'))
                            <span class="text-danger">{{ $errors->first('topic_ro') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.topic_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="topic_en">{{ trans('cruds.course.fields.topic') }}(en)</label>
                        <input class="form-control {{ $errors->has('topic_en') ? 'is-invalid' : '' }}" type="text"
                               name="topic_en"
                               id="topic_en" value="{{ old('topic_en', '') }}">
                        @if($errors->has('topic_en'))
                            <span class="text-danger">{{ $errors->first('topic_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.topic_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="published_at">{{ trans('cruds.course.fields.published_at') }}</label>
                        <input name="published_at" type='text' class="form-control datetime" id='datetimepicker'/>
                        @if($errors->has('published_at'))
                            <span class="text-danger">{{ $errors->first('published_at') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.published_at_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="required" for="access">{{ trans('cruds.subCategory.fields.access') }}</label>
                        <select class="form-control select2 {{ $errors->has('access') ? 'is-invalid' : '' }}"
                                name="access" id="access" required>
                            @foreach($accessTypes as $access)
                                <option
                                    value="{{ $access }}" {{ old('access') ? 'selected' : '' }}>{{ $access }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('access'))
                            <span class="text-danger">{{ $errors->first('access') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.access_helper') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="" for="document_ids">{{ trans('global.documents') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('documents') ? 'is-invalid' : '' }}"
                            name="document_ids[]"
                            id="document_ids" multiple >
                        @foreach($documents as $id => $document)
                            <option value="{{ $id }}" {{ in_array($id, old('document_ids', [])) ? 'selected' : '' }}>{{ $document }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('document_ids'))
                        <span class="text-danger">{{ $errors->first('document_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="" for="category_ids">{{ trans('global.categories') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                            name="category_ids[]"
                            id="category_ids" multiple >
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}" {{ in_array($id, old('category_ids', [])) ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_ids'))
                        <span class="text-danger">{{ $errors->first('category_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="" for="role_ids">{{ trans('cruds.user.fields.access_roles') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                            name="role_ids[]"
                            id="role_ids" multiple >
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ in_array($id, old('role_ids', [])) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('role_ids'))
                        <span class="text-danger">{{ $errors->first('role_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="" for="user_ids">{{ trans('cruds.user.fields.access_users') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}"
                            name="user_ids[]"
                            id="user_ids" multiple >
                        @foreach($users as $id => $user)
                            <option value="{{ $id }}" {{ in_array($id, old('user_ids', [])) ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user_ids'))
                        <span class="text-danger">{{ $errors->first('user_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">{{ trans('cruds.course.fields.description') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}"
                              name="description" id="description">{!! old('description') !!}</textarea>
                    @if($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="file">{{ trans('cruds.course.fields.image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}"
                         id="image-drop-zone">
                    </div>
                    @if($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.image_helper') }}</span>
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
        $(function () {
            $('#datetimepicker').datetimepicker({
                minDate: moment().startOf('minute').add(180, 'm'),
            });

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(allEditors[i]);
            }
        });

        let imageDropZone = new Dropzone("#image-drop-zone", {
            url: '{{ route('admin.courses.storeMedia') }}',
            maxFilesize: 2000, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2000
            },
            acceptedFiles: "image/*",
            success: function (file, response) {
                $('form').find('input[name="file"]').remove()
                $('form').append('<input type="hidden" name="image_path" value="' + response.file_path + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
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
        })

    </script>
@endsection
