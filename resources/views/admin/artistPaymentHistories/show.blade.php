@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.artistPaymentHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-payment-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.txn_type') }}
                        </th>
                        <td>
                            {{ App\ArtistPaymentHistory::TXN_TYPE_SELECT[$artistPaymentHistory->txn_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.any_fees') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->any_fees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.any_charges') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->any_charges }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.final_amount') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->final_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.txn_for') }}
                        </th>
                        <td>
                            {{ App\ArtistPaymentHistory::TXN_FOR_SELECT[$artistPaymentHistory->txn_for] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.txn_info') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->txn_info }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.status') }}
                        </th>
                        <td>
                            {{ App\ArtistPaymentHistory::STATUS_SELECT[$artistPaymentHistory->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.proccesed_by') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->proccesed_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.user') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->user->referred_by ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistPaymentHistory.fields.earn_from') }}
                        </th>
                        <td>
                            {{ $artistPaymentHistory->earn_from->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-payment-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection