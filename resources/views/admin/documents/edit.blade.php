@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.document.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.documents.update", [$document->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_ru">{{ trans('cruds.document.fields.name') }} (ru)</label>
                        <input class="form-control {{ $errors->has('name_ru') ? 'is-invalid' : '' }}" type="text"
                               name="name_ru"
                               id="name_ru" value="{{ old('name_ru', $document->name_ru) }}">
                        @if($errors->has('name_ru'))
                            <span class="text-danger">{{ $errors->first('name_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_ro">{{ trans('cruds.document.fields.name') }} (ro)</label>
                        <input class="form-control {{ $errors->has('name_ro') ? 'is-invalid' : '' }}" type="text"
                               name="name_ro"
                               id="name_ro" value="{{ old('name_ro', $document->name_ro) }}">
                        @if($errors->has('name_ro'))
                            <span class="text-danger">{{ $errors->first('name_ro') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_en">{{ trans('cruds.document.fields.name') }} (en)</label>
                        <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text"
                               name="name_en"
                               id="name_en" value="{{ old('name_en', $document->name_en) }}">
                        @if($errors->has('name_en'))
                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.name_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_issuer_ru">{{ trans('cruds.document.fields.name_issuer') }}
                            (ru)</label>
                        <input class="form-control {{ $errors->has('name_issuer_ru') ? 'is-invalid' : '' }}" type="text"
                               name="name_issuer_ru"
                               id="name_issuer_ru" value="{{ old('name_issuer_ru', $document->name_issuer_ru) }}">
                        @if($errors->has('name_issuer_ru'))
                            <span class="text-danger">{{ $errors->first('name_issuer_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.name_issuer_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_issuer_ro">{{ trans('cruds.document.fields.name_issuer') }}
                            (ro)</label>
                        <input class="form-control {{ $errors->has('name_issuer_ro') ? 'is-invalid' : '' }}" type="text"
                               name="name_issuer_ro"
                               id="name_issuer_ro" value="{{ old('name_issuer_ro', $document->name_issuer_ro) }}">
                        @if($errors->has('name_issuer_ro'))
                            <span class="text-danger">{{ $errors->first('name_issuer_ro') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.name_issuer_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="name_issuer_en">{{ trans('cruds.document.fields.name_issuer') }}
                            (en)</label>
                        <input class="form-control {{ $errors->has('name_issuer_en') ? 'is-invalid' : '' }}" type="text"
                               name="name_issuer_en"
                               id="name_issuer_en" value="{{ old('name_issuer_en', $document->name_issuer_en) }}">
                        @if($errors->has('name_issuer_en'))
                            <span class="text-danger">{{ $errors->first('name_issuer_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.name_issuer_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="topic_ru">{{ trans('cruds.document.fields.topic') }} (ru)</label>
                        <input class="form-control {{ $errors->has('topic_ru') ? 'is-invalid' : '' }}" type="text"
                               name="topic_ru"
                               id="topic_ru" value="{{ old('topic_ru', $document->topic_ru) }}">
                        @if($errors->has('topic_ru'))
                            <span class="text-danger">{{ $errors->first('topic_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.topic_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="topic_ro">{{ trans('cruds.document.fields.topic') }} (ro)</label>
                        <input class="form-control {{ $errors->has('topic_ro') ? 'is-invalid' : '' }}" type="text"
                               name="topic_ro"
                               id="topic_ro" value="{{ old('topic_ro', $document->topic_ro) }}">
                        @if($errors->has('topic_ro'))
                            <span class="text-danger">{{ $errors->first('topic_ro') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.topic_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="topic_en">{{ trans('cruds.document.fields.topic') }} (en)</label>
                        <input class="form-control {{ $errors->has('topic_en') ? 'is-invalid' : '' }}" type="text"
                               name="topic_en"
                               id="topic_en" value="{{ old('topic_en', $document->topic_en) }}">
                        @if($errors->has('topic_en'))
                            <span class="text-danger">{{ $errors->first('topic_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.topic_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="type_ru">{{ trans('cruds.document.fields.type') }} (ru)</label>
                        <input class="form-control {{ $errors->has('type_ru') ? 'is-invalid' : '' }}" type="text"
                               name="type_ru"
                               id="type_ru" value="{{ old('type_ru', $document->type_ru) }}">
                        @if($errors->has('type_ru'))
                            <span class="text-danger">{{ $errors->first('type_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.type_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="type_ro">{{ trans('cruds.document.fields.type') }} (ro)</label>
                        <input class="form-control {{ $errors->has('type_ro') ? 'is-invalid' : '' }}" type="text"
                               name="type_ro"
                               id="type_ro" value="{{ old('type_ro', $document->type_ro) }}">
                        @if($errors->has('type_ro'))
                            <span class="text-danger">{{ $errors->first('type_ro') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.type_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="type_en">{{ trans('cruds.document.fields.type') }} (en)</label>
                        <input class="form-control {{ $errors->has('type_en') ? 'is-invalid' : '' }}" type="text"
                               name="type_en"
                               id="type_en" value="{{ old('type_en', $document->type_en) }}">
                        @if($errors->has('type_en'))
                            <span class="text-danger">{{ $errors->first('type_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.type_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="number">{{ trans('cruds.document.fields.number') }}</label>
                        <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="text"
                               name="number"
                               id="number" value="{{ old('number', $document->number) }}">
                        @if($errors->has('number'))
                            <span class="text-danger">{{ $errors->first('number') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.name_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="approved_at">{{ trans('cruds.document.fields.approved_at') }}</label>
                        <input name="approved_at" type='text' class="form-control datetime" id='datetimepicker'
                               value="{{ $document->approved_at ?? '' }}"/>
                        @if($errors->has('approved_at'))
                            <span class="text-danger">{{ $errors->first('approved_at') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.approved_at_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="" for="published_at">{{ trans('cruds.document.fields.published_at') }}</label>
                        <input name="published_at" type='text' class="form-control datetime" id='datetimepicker'
                               value="{{ $document->published_at ?? '' }}"/>
                        @if($errors->has('published_at'))
                            <span class="text-danger">{{ $errors->first('published_at') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.published_at_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="required" for="status">{{ trans('cruds.document.fields.status') }}</label>
                        <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                name="status" id="status" required>
                            @foreach($statusesSelect as $status)
                                <option
                                    value="{{ $status }}" {{ old('access', $document->status) === $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ implode(", ", $statuses) }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                        <label class="required" for="access">{{ trans('cruds.subCategory.fields.access') }}</label>
                        <select class="form-control select2 {{ $errors->has('access') ? 'is-invalid' : '' }}"
                                name="access" id="access" required>
                            @foreach($accessTypes as $access)
                                <option
                                    value="{{ $access }}" {{ $access }}
                                " {{ old('access', $document->access) === $access ? 'selected' : '' }}
                                >{{ $access }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('access'))
                            <span class="text-danger">{{ $errors->first('access') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.document.fields.access_helper') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="" for="category_ids">{{ trans('global.categories') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('category_ids') ? 'is-invalid' : '' }}"
                            name="category_ids[]"
                            id="category_ids" multiple>
                        @foreach($allCategories as $id => $category)
                            <option
                                value="{{ $id }}" {{ in_array($id, old('category_ids', $categoryIds)) ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_ids'))
                        <span class="text-danger">{{ $errors->first('category_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="" for="sub_category_ids">{{ trans('global.sub_categories') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('sub_category_ids') ? 'is-invalid' : '' }}"
                            name="sub_category_ids[]"
                            id="sub_category_ids" multiple>
                        @foreach($allSubCategories as $id => $subCategory)
                            <option
                                value="{{ $id }}" {{ in_array($id, old('sub_category_ids', $subCategoryIds)) ? 'selected' : '' }}>{{ $subCategory }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('sub_category_ids'))
                        <span class="text-danger">{{ $errors->first('sub_category_ids') }}</span>
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
                    <select class="form-control select2 {{ $errors->has('role_ids') ? 'is-invalid' : '' }}"
                            name="role_ids[]"
                            id="role_ids" multiple>
                        @foreach($allRoles as $id => $role)
                            <option
                                value="{{ $id }}" {{ in_array($id, old('role_ids', $roleIds)) ? 'selected' : '' }}>{{ $role }}</option>
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
                    <select class="form-control select2 {{ $errors->has('user_ids') ? 'is-invalid' : '' }}"
                            name="user_ids[]"
                            id="user_ids" multiple>
                        @foreach($allUsers as $id => $user)
                            <option
                                value="{{ $id }}" {{ in_array($id, old('user_ids', $userIds)) ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user_ids'))
                        <span class="text-danger">{{ $errors->first('user_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="" for="related_document_ids">{{ trans('cruds.document.fields.related_documents') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}"
                            name="related_document_ids[]"
                            id="related_document_ids" multiple>
                        @foreach($allDocuments as $id => $relatedDocument)
                            <option
                                value="{{ $id }}" {{ in_array($id, old('related_document_ids', $relatedDocumentIds)) ? 'selected' : '' }}>{{ $relatedDocument }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('related_document_ids'))
                        <span class="text-danger">{{ $errors->first('related_document_ids') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description_ru">{{ trans('cruds.course.fields.description') }} (ru)</label>
                    <textarea class="form-control ckeditor {{ $errors->has('description_ru') ? 'is-invalid' : '' }}"
                              name="description_ru" id="description_ru">{!! old('description_ru', $document->description_ru) !!}</textarea>
                    @if($errors->has('description_ru'))
                        <span class="text-danger">{{ $errors->first('description_ru') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="description_ro">{{ trans('cruds.course.fields.description') }} (ro)</label>
                    <textarea class="form-control ckeditor {{ $errors->has('description_ro') ? 'is-invalid' : '' }}"
                              name="description_ro" id="description_ro">{!! old('description_ro', $document->description_ro) !!}</textarea>
                    @if($errors->has('description_ro'))
                        <span class="text-danger">{{ $errors->first('description_ro') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="description_en">{{ trans('cruds.course.fields.description') }} (en)</label>
                    <textarea class="form-control ckeditor {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                              name="description_en" id="description_en">{!! old('description_en', $document->description_en) !!}</textarea>
                    @if($errors->has('description_en'))
                        <span class="text-danger">{{ $errors->first('description_en') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="file">{{ trans('cruds.document.fields.file') }}</label>
                    <div>{!! sprintf('<a href="%s" target="_blank">' . __('cruds.document.fields.show_file') . ')</a>', storageUrl($document->file_path)) !!}</div>
                    <p><a href="#" id="show-file-dropzone">{{ __('cruds.document.fields.add_new_file') }}</a></p>
                    <input type="hidden" name="file_path" value="{{ $document->file_path ?? '' }}">
                    <span id="file-dropzone" style="{{ $document->image_path ? 'display: none;' : '' }};">
                        <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}"
                             id="file-drop-zone">
                        </div>
                    </span>
                    @if($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.document.fields.file_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="file">{{ trans('cruds.document.fields.image') }}</label>
                    <div>{!! sprintf('<img src="%s" style="max-width: 200px;" />', storageUrl($document->image_path, 'medium')) !!}</div>
                    <p><a href="#" id="show-image-dropzone">Add New Image</a></p>
                    <input type="hidden" name="image_path" value="{{ $document->image_path ?? '' }}">
                    <span id="image-dropzone" style="{{ $document->image_path ? 'display: none;' : '' }};">
                        <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}"
                             id="image-drop-zone">
                        </div>
                        </span>
                    @if($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.document.fields.image_helper') }}</span>
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

            $('#show-image-dropzone').click(function (e) {
                e.preventDefault();
                $('#image-dropzone').show();
            });

            $('#show-file-dropzone').click(function (e) {
                e.preventDefault();
                $('#file-dropzone').show();
            });
        });

        let fileDropZone = new Dropzone("#file-drop-zone", {
            url: '{{ route('admin.documents.storeMedia') }}',
            maxFilesize: 2000, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2000
            },
            acceptedFiles: "application/pdf,.docx",
            success: function (file, response) {
                $('form').find('input[name="file"]').remove()
                $('form').append('<input type="hidden" name="file_path" value="' + response.file_path + '">')
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

        let imageDropZone = new Dropzone("#image-drop-zone", {
            url: '{{ route('admin.documents.storeMedia') }}',
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
