@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.adminUser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.adminUser.fields.id') }}
                        </th>
                        <td>
                            {{ $adminUser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminUser.fields.username') }}
                        </th>
                        <td>
                            {{ $adminUser->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminUser.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminUser.fields.role') }}
                        </th>
                        <td>
                            {{ $adminUser->role->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminUser.fields.email') }}
                        </th>
                        <td>
                            {{ $adminUser->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminUser.fields.status') }}
                        </th>
                        <td>
                            {{ App\AdminUser::STATUS_SELECT[$adminUser->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin-users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection