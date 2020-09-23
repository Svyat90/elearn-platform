@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.id') }}
                        </th>
                        <td>
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.name') }}
                        </th>
                        <td>
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.access') }}
                        </th>
                        <td>
                            {!! labelAccess($category->access) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.created_at') }}
                        </th>
                        <td>
                            {{ $category->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
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
            <a class="nav-link" href="#parent_sub_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.subCategory.title') }}
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
        <div class="tab-pane" role="tabpanel" id="parent_sub_categories">
            @includeIf('admin.partials.relationships.accessSubCategories', ['subCategories' => $category->subCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_users">
            @includeIf('admin.partials.relationships.accessUsers', ['users' => $category->users])
        </div>
        <div class="tab-pane" role="tabpanel" id="access_roles">
            @includeIf('admin.partials.relationships.accessRoles', ['roles' => $category->roles])
        </div>
    </div>
</div>

@endsection
