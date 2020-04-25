@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userMetum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userMetum.fields.id') }}
                        </th>
                        <td>
                            {{ $userMetum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMetum.fields.user') }}
                        </th>
                        <td>
                            {{ $userMetum->user->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMetum.fields.bio') }}
                        </th>
                        <td>
                            {!! $userMetum->bio !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMetum.fields.wallet_balance') }}
                        </th>
                        <td>
                            {{ $userMetum->wallet_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMetum.fields.wishlist') }}
                        </th>
                        <td>
                            @foreach($userMetum->wishlists as $key => $wishlist)
                                <span class="label label-info">{{ $wishlist->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection