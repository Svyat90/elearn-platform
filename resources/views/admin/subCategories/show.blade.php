@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $subCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $subCategory->{localeColumn('name')} }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.parent') }}
                        </th>
                        <td>
                            {{ $subCategory->parent->{localeColumn('name')} ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.access') }}
                        </th>
                        <td>
                            {!! labelAccess($subCategory->access) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.created_at') }}
                        </th>
                        <td>
                            {{ $subCategory->created_at ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-categories.index') }}">
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
            <a class="nav-link" href="#access_documents" role="tab" data-toggle="tab">
                {{ trans('global.access_documents') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="access_users">
            @includeIf('admin.partials.relationships.accessUsers', ['users' => $subCategory->users])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_roles">
            @includeIf('admin.partials.relationships.accessRoles', ['roles' => $subCategory->roles])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_documents">
            @includeIf('admin.partials.relationships.accessDocuments', ['documents' => $subCategory->documents])
        </div>
    </div>
</div>

@endsection
