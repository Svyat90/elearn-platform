@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userWalletHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-wallet-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userWalletHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $userWalletHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userWalletHistory.fields.txn_type') }}
                        </th>
                        <td>
                            {{ App\UserWalletHistory::TXN_TYPE_SELECT[$userWalletHistory->txn_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userWalletHistory.fields.amount') }}
                        </th>
                        <td>
                            {{ $userWalletHistory->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userWalletHistory.fields.txn_info') }}
                        </th>
                        <td>
                            {{ $userWalletHistory->txn_info }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userWalletHistory.fields.status') }}
                        </th>
                        <td>
                            {{ App\UserWalletHistory::STATUS_SELECT[$userWalletHistory->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userWalletHistory.fields.user') }}
                        </th>
                        <td>
                            {{ $userWalletHistory->user->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userWalletHistory.fields.earn_from') }}
                        </th>
                        <td>
                            {{ $userWalletHistory->earn_from->first_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-wallet-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection