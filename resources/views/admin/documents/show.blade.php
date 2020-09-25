@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.document.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                @foreach($document->getFillable() as $field)
                    @if($field === 'image_path')
                        <tr>
                            <th>Image</th>
                            <td>{!! sprintf('<img src="%s" width="100px" />', storageUrl($document->{$field})) !!}</td>
                        </tr>
                    @elseif($field === 'file_path')
                        @php
                        $link = storageUrl($document->{$field});
                        $segments = explode("/", $link);
                        @endphp
                        <tr>
                            <th>File (PDF)</th>
                            <td>{!! $link ? sprintf('<a href="%s" target="_blank" />%s</a>', $link, $segments[count($segments)-1]) : '' !!}</td>
                        </tr>
                    @elseif($field === 'access')
                        <tr>
                            <th>{{ trans("cruds.document.fields.{$field}") }}</th>
                            <td>{!! labelAccess($document->{$field}) !!}</td>
                        </tr>
                    @elseif($field === 'status')
                        <tr>
                            <th>{{ trans("cruds.document.fields.{$field}") }}</th>
                            <td>{!! labelStatus($document->{$field}) !!}</td>
                        </tr>
                    @else
                        <tr>
                            <th>{{ trans("cruds.document.fields.{$field}") }}</th>
                            <td>{{ $document->{$field} }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
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
                {{ trans('global.access_categories') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_sub_categories" role="tab" data-toggle="tab">
                {{ trans('global.access_sub_categories') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_users" role="tab" data-toggle="tab">
                {{ trans('global.access_users') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_roles" role="tab" data-toggle="tab">
                {{ trans('global.access_roles') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_courses" role="tab" data-toggle="tab">
                {{ trans('global.access_courses') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_documents" role="tab" data-toggle="tab">
                {{ trans('global.related_documents') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="access_categories">
            @includeIf('admin.partials.relationships.accessCategories', ['categories' => $document->categories])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_sub_categories">
            @includeIf('admin.partials.relationships.accessSubCategories', ['subCategories' => $document->subCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_users">
            @includeIf('admin.partials.relationships.accessUsers', ['users' => $document->users])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_roles">
            @includeIf('admin.partials.relationships.accessRoles', ['roles' => $document->roles])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_courses">
            @includeIf('admin.partials.relationships.accessCourses', ['courses' => $document->courses])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_documents">
            @includeIf('admin.partials.relationships.accessDocuments', ['documents' => $document->relatedDocuments])
        </div>
    </div>
</div>

@endsection

