@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.role.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <td>
                            {{ $role->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
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
            <a class="nav-link" href="#roles_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.user.fields.access_categories') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#parent_sub_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.subCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#access_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.user.fields.access_courses') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#related_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.fields.related_documents') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="roles_users">
            @includeIf('admin.partials.relationships.accessUsers', ['users' => $role->rolesUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_categories">
            @includeIf('admin.partials.relationships.accessCategories', ['categories' => $role->categories])
        </div>
        <div class="tab-pane" role="tabpanel" id="parent_sub_categories">
            @includeIf('admin.partials.relationships.accessSubCategories', ['subCategories' => $role->subCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_courses">
            @includeIf('admin.partials.relationships.accessCourses', ['courses' => $role->courses])
        </div>
        <div class="tab-pane" role="tabpanel" id="related_documents">
            @includeIf('admin.partials.relationships.accessDocuments', ['documents' => $role->documents])
        </div>
    </div>
</div>

@endsection
