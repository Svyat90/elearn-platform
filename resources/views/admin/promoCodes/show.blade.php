@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.promoCode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.promo-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.promoCode.fields.id') }}
                        </th>
                        <td>
                            {{ $promoCode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promoCode.fields.promo_code') }}
                        </th>
                        <td>
                            {{ $promoCode->promo_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promoCode.fields.discount') }}
                        </th>
                        <td>
                            {{ $promoCode->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promoCode.fields.minimum_order_value') }}
                        </th>
                        <td>
                            {{ $promoCode->minimum_order_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promoCode.fields.start_date') }}
                        </th>
                        <td>
                            {{ $promoCode->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promoCode.fields.end_date') }}
                        </th>
                        <td>
                            {{ $promoCode->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promoCode.fields.promotion_info') }}
                        </th>
                        <td>
                            {!! $promoCode->promotion_info !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.promo-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection