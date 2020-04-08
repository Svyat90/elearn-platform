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
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
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
                            {{ trans('cruds.user.fields.dob') }}
                        </th>
                        <td>
                            {{ $user->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.position_occupation') }}
                        </th>
                        <td>
                            {{ $user->position_occupation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.subscribers') }}
                        </th>
                        <td>
                            {{ $user->subscribers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.bio') }}
                        </th>
                        <td>
                            {{ $user->bio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.language') }}
                        </th>
                        <td>
                            @foreach($user->languages as $key => $language)
                                <span class="label label-info">{{ $language->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.country') }}
                        </th>
                        <td>
                            {{ $user->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.social_meidia') }}
                        </th>
                        <td>
                            @foreach($user->social_meidias as $key => $social_meidia)
                                <span class="label label-info">{{ $social_meidia->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.category') }}
                        </th>
                        <td>
                            @foreach($user->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th>
                        <td>
                            {{ $user->gender->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.referral_code') }}
                        </th>
                        <td>
                            {{ $user->referral_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.referred_by') }}
                        </th>
                        <td>
                            {{ $user->referred_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.registration_platform') }}
                        </th>
                        <td>
                            {{ App\User::REGISTRATION_PLATFORM_SELECT[$user->registration_platform] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.image') }}
                        </th>
                        <td>
                            @if($user->image)
                                <a href="{{ $user->image->getUrl() }}" target="_blank">
                                    <img src="{{ $user->image->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.status') }}
                        </th>
                        <td>
                            {{ App\User::STATUS_SELECT[$user->status] ?? '' }}
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
            <a class="nav-link" href="#user_user_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.userReview.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_videos" role="tab" data-toggle="tab">
                {{ trans('cruds.video.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_order_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.orderHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_login_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.loginLog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_payment_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentLog.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_user_reviews">
            @includeIf('admin.users.relationships.userUserReviews', ['userReviews' => $user->userUserReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_orders">
            @includeIf('admin.users.relationships.userOrders', ['orders' => $user->userOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_videos">
            @includeIf('admin.users.relationships.userVideos', ['videos' => $user->userVideos])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_order_histories">
            @includeIf('admin.users.relationships.userOrderHistories', ['orderHistories' => $user->userOrderHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_login_logs">
            @includeIf('admin.users.relationships.userLoginLogs', ['loginLogs' => $user->userLoginLogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_payment_logs">
            @includeIf('admin.users.relationships.userPaymentLogs', ['paymentLogs' => $user->userPaymentLogs])
        </div>
    </div>
</div>

@endsection