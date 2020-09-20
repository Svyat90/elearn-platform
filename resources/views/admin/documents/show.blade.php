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
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="access_categories">
            @includeIf('admin.documents.relationships.accessCategories', ['categories' => $document->categories])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_users">
            @includeIf('admin.documents.relationships.accessUsers', ['users' => $document->users])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_roles">
            @includeIf('admin.documents.relationships.accessRoles', ['roles' => $document->roles])
        </div>
    </div>
</div>

@endsection

