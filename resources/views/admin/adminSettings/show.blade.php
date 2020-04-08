@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.adminSetting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.id') }}
                        </th>
                        <td>
                            {{ $adminSetting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.user_commission') }}
                        </th>
                        <td>
                            {{ $adminSetting->user_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.artist_commission') }}
                        </th>
                        <td>
                            {{ $adminSetting->artist_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.agent_commission') }}
                        </th>
                        <td>
                            {{ $adminSetting->agent_commission }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection