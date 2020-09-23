@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.first_name') }}
                        </th>
                        <td>
                            {{ $user->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.last_name') }}
                        </th>
                        <td>
                            {{ $user->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.position') }}
                        </th>
                        <td>
                            {{ $user->position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.institution') }}
                        </th>
                        <td>
                            {{ $user->institution }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.user_status') }}
                        </th>
                        <td>
                            {{ App\User::USER_STATUS_SELECT[$user->user_status] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
                @includeIf('admin.partials.relationships.accessCategories', ['categories' => $user->categories])
            </div>
            <div class="tab-pane" role="tabpanel" id="parent_sub_categories">
                @includeIf('admin.partials.relationships.accessSubCategories', ['subCategories' => $user->subCategories])
            </div>
            <div class="tab-pane" role="tabpanel" id="access_courses">
                @includeIf('admin.partials.relationships.accessCourses', ['courses' => $user->courses])
            </div>
            <div class="tab-pane" role="tabpanel" id="access_roles">
                @includeIf('admin.partials.relationships.accessRoles', ['roles' => $user->roles])
            </div>
            <div class="tab-pane" role="tabpanel" id="access_documents">
                @includeIf('admin.partials.relationships.accessDocuments', ['documents' => $user->documents])
            </div>
        </div>
    </div>

@endsection
