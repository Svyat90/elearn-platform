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
                            {{ trans('cruds.user.fields.mobile_no') }}
                        </th>
                        <td>
                            {{ $user->mobile_no }}
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
                            {{ trans('cruds.user.fields.ig_token') }}
                        </th>
                        <td>
                            {{ $user->ig_token }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.ig_username') }}
                        </th>
                        <td>
                            {{ $user->ig_username }}
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
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.birth_date') }}
                        </th>
                        <td>
                            {{ $user->birth_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.avatar') }}
                        </th>
                        <td>
                            @if($user->avatar)
                                <a href="{{ $user->avatar->getUrl() }}" target="_blank">
                                    <img src="{{ $user->avatar->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.registration_source') }}
                        </th>
                        <td>
                            {{ App\User::REGISTRATION_SOURCE_SELECT[$user->registration_source] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.registered_on') }}
                        </th>
                        <td>
                            {{ $user->registered_on }}
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
            <a class="nav-link" href="#user_login_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.loginLog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_payment_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentLog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_artist_payment_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.artistPaymentHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#earn_from_artist_payment_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.artistPaymentHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_agent_payment_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.agentPaymentHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#earn_from_agent_payment_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.agentPaymentHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_agent_meta" role="tab" data-toggle="tab">
                {{ trans('cruds.agentMetum.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#artist_artist_meta" role="tab" data-toggle="tab">
                {{ trans('cruds.artistMetum.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_meta" role="tab" data-toggle="tab">
                {{ trans('cruds.userMetum.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_wallet_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.userWalletHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#earn_from_user_wallet_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.userWalletHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#artist_artist_enquiries" role="tab" data-toggle="tab">
                {{ trans('cruds.artistEnquiry.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#agent_agent_meta" role="tab" data-toggle="tab">
                {{ trans('cruds.agentMetum.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_wishlists" role="tab" data-toggle="tab">
                {{ trans('cruds.userWishlist.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_orders">
            @includeIf('admin.users.relationships.userOrders', ['orders' => $user->userOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_videos">
            @includeIf('admin.users.relationships.userVideos', ['videos' => $user->userVideos])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_login_logs">
            @includeIf('admin.users.relationships.userLoginLogs', ['loginLogs' => $user->userLoginLogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_payment_logs">
            @includeIf('admin.users.relationships.userPaymentLogs', ['paymentLogs' => $user->userPaymentLogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_artist_payment_histories">
            @includeIf('admin.users.relationships.userArtistPaymentHistories', ['artistPaymentHistories' => $user->userArtistPaymentHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="earn_from_artist_payment_histories">
            @includeIf('admin.users.relationships.earnFromArtistPaymentHistories', ['artistPaymentHistories' => $user->earnFromArtistPaymentHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_agent_payment_histories">
            @includeIf('admin.users.relationships.userAgentPaymentHistories', ['agentPaymentHistories' => $user->userAgentPaymentHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="earn_from_agent_payment_histories">
            @includeIf('admin.users.relationships.earnFromAgentPaymentHistories', ['agentPaymentHistories' => $user->earnFromAgentPaymentHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_agent_meta">
            @includeIf('admin.users.relationships.userAgentMeta', ['agentMeta' => $user->userAgentMeta])
        </div>
        <div class="tab-pane" role="tabpanel" id="artist_artist_meta">
            @includeIf('admin.users.relationships.artistArtistMeta', ['artistMeta' => $user->artistArtistMeta])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_meta">
            @includeIf('admin.users.relationships.userUserMeta', ['userMeta' => $user->userUserMeta])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_wallet_histories">
            @includeIf('admin.users.relationships.userUserWalletHistories', ['userWalletHistories' => $user->userUserWalletHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="earn_from_user_wallet_histories">
            @includeIf('admin.users.relationships.earnFromUserWalletHistories', ['userWalletHistories' => $user->earnFromUserWalletHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="artist_artist_enquiries">
            @includeIf('admin.users.relationships.artistArtistEnquiries', ['artistEnquiries' => $user->artistArtistEnquiries])
        </div>
        <div class="tab-pane" role="tabpanel" id="agent_agent_meta">
            @includeIf('admin.users.relationships.agentAgentMeta', ['agentMeta' => $user->agentAgentMeta])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_wishlists">
            @includeIf('admin.users.relationships.userUserWishlists', ['userWishlists' => $user->userUserWishlists])
        </div>
    </div>
</div>

@endsection