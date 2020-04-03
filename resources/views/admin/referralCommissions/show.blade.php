@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.referralCommission.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.referral-commissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.referralCommission.fields.id') }}
                        </th>
                        <td>
                            {{ $referralCommission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referralCommission.fields.user_commission') }}
                        </th>
                        <td>
                            {{ $referralCommission->user_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referralCommission.fields.artist_commission') }}
                        </th>
                        <td>
                            {{ $referralCommission->artist_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referralCommission.fields.agent_commission') }}
                        </th>
                        <td>
                            {{ $referralCommission->agent_commission }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.referral-commissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection