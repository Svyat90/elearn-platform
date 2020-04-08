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
                            {{ trans('cruds.adminSetting.fields.company_commission') }}
                        </th>
                        <td>
                            {{ $adminSetting->company_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.referral_user_commision') }}
                        </th>
                        <td>
                            {{ $adminSetting->referral_user_commision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.referal_artist_commision') }}
                        </th>
                        <td>
                            {{ $adminSetting->referal_artist_commision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.referal_agent_commision') }}
                        </th>
                        <td>
                            {{ $adminSetting->referal_agent_commision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.artist_video_show_count_web') }}
                        </th>
                        <td>
                            {{ $adminSetting->artist_video_show_count_web }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminSetting.fields.artist_video_show_count_app') }}
                        </th>
                        <td>
                            {{ $adminSetting->artist_video_show_count_app }}
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