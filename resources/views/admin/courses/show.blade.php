@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.course.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                @foreach($course->getFillable() as $field)
                    @if($field === 'image_path')
                        <tr>
                            <th>Image</th>
                            <td>{!! sprintf('<img src="%s" width="100px" />', storageUrl($course->{$field}, 'medium')) !!}</td>
                        </tr>
                    @elseif($field === 'access')
                        <tr>
                            <th>{{ trans("cruds.document.fields.{$field}") }}</th>
                            <td>{!! labelAccess($course->{$field}) !!}</td>
                        </tr>
                    @elseif($field === 'status')
                        <tr>
                            <th>{{ trans("cruds.document.fields.{$field}") }}</th>
                            <td>{!! labelStatus($course->{$field}) !!}</td>
                        </tr>
                    @elseif(strpos($field, "description") !== false)
                        <tr>
                            <th>{{ trans("cruds.document.fields.{$field}") }}</th>
                            <td>{!! $course->{$field} !!}</td>
                        </tr>
                    @else
                        <tr>
                            <th>{{ trans("cruds.course.fields.{$field}") }}</th>
                            <td>{{ $course->{$field} }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#access_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.user.fields.access_categories') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.fields.access_users') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.user.fields.access_roles') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.user.fields.access_documents') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="access_categories">
            @includeIf('admin.partials.relationships.accessCategories', ['categories' => $course->categories])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_users">
            @includeIf('admin.partials.relationships.accessUsers', ['users' => $course->users])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_roles">
            @includeIf('admin.partials.relationships.accessRoles', ['roles' => $course->roles])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_documents">
            @includeIf('admin.partials.relationships.accessDocuments', ['documents' => $course->documents])
        </div>
    </div>
</div>

@endsection

