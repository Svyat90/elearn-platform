<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }} {{ request()->is('admin/audit-logs*') ? 'menu-open' : '' }} {{ request()->is('admin/admin-users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin_user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.admin-users.index") }}" class="nav-link {{ request()->is('admin/admin-users') || request()->is('admin/admin-users/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.adminUser.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('customer_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/customers-lists*') ? 'menu-open' : '' }} {{ request()->is('admin/user-meta*') ? 'menu-open' : '' }} {{ request()->is('admin/user-wallet-histories*') ? 'menu-open' : '' }} {{ request()->is('admin/user-reviews*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users-cog">

                            </i>
                            <p>
                                {{ trans('cruds.customerManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('customers_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.customers-lists.index") }}" class="nav-link {{ request()->is('admin/customers-lists') || request()->is('admin/customers-lists/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.customersList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_metum_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-meta.index") }}" class="nav-link {{ request()->is('admin/user-meta') || request()->is('admin/user-meta/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userMetum.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_wallet_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-wallet-histories.index") }}" class="nav-link {{ request()->is('admin/user-wallet-histories') || request()->is('admin/user-wallet-histories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userWalletHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_review_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-reviews.index") }}" class="nav-link {{ request()->is('admin/user-reviews') || request()->is('admin/user-reviews/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-comment-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userReview.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('artist_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/artist-lists*') ? 'menu-open' : '' }} {{ request()->is('admin/artist-meta*') ? 'menu-open' : '' }} {{ request()->is('admin/artist-enquiries*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-user-graduate">

                            </i>
                            <p>
                                {{ trans('cruds.artistManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('artist_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.artist-lists.index") }}" class="nav-link {{ request()->is('admin/artist-lists') || request()->is('admin/artist-lists/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.artistList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('artist_metum_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.artist-meta.index") }}" class="nav-link {{ request()->is('admin/artist-meta') || request()->is('admin/artist-meta/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-cog">

                                        </i>
                                        <p>
                                            {{ trans('cruds.artistMetum.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('artist_enquiry_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.artist-enquiries.index") }}" class="nav-link {{ request()->is('admin/artist-enquiries') || request()->is('admin/artist-enquiries/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-graduate">

                                        </i>
                                        <p>
                                            {{ trans('cruds.artistEnquiry.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('agent_mangement_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/agent-lists*') ? 'menu-open' : '' }} {{ request()->is('admin/agent-meta*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-user-tie">

                            </i>
                            <p>
                                {{ trans('cruds.agentMangement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('agent_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.agent-lists.index") }}" class="nav-link {{ request()->is('admin/agent-lists') || request()->is('admin/agent-lists/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.agentList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('agent_metum_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.agent-meta.index") }}" class="nav-link {{ request()->is('admin/agent-meta') || request()->is('admin/agent-meta/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-users-cog">

                                        </i>
                                        <p>
                                            {{ trans('cruds.agentMetum.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('media_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/videos*') ? 'menu-open' : '' }} {{ request()->is('admin/user-profile-avatar-images*') ? 'menu-open' : '' }} {{ request()->is('admin/talent-profile-images*') ? 'menu-open' : '' }} {{ request()->is('admin/talent-profile-intro-videos*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-video">

                            </i>
                            <p>
                                {{ trans('cruds.mediaManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('video_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.videos.index") }}" class="nav-link {{ request()->is('admin/videos') || request()->is('admin/videos/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-file-video">

                                        </i>
                                        <p>
                                            {{ trans('cruds.video.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_profile_avatar_image_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-profile-avatar-images.index") }}" class="nav-link {{ request()->is('admin/user-profile-avatar-images') || request()->is('admin/user-profile-avatar-images/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-image">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userProfileAvatarImage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('talent_profile_image_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.talent-profile-images.index") }}" class="nav-link {{ request()->is('admin/talent-profile-images') || request()->is('admin/talent-profile-images/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-image">

                                        </i>
                                        <p>
                                            {{ trans('cruds.talentProfileImage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('talent_profile_intro_video_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.talent-profile-intro-videos.index") }}" class="nav-link {{ request()->is('admin/talent-profile-intro-videos') || request()->is('admin/talent-profile-intro-videos/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-file-video">

                                        </i>
                                        <p>
                                            {{ trans('cruds.talentProfileIntroVideo.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('orders_list_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/orders*') ? 'menu-open' : '' }} {{ request()->is('admin/order-payments*') ? 'menu-open' : '' }} {{ request()->is('admin/artist-responses*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                            </i>
                            <p>
                                {{ trans('cruds.ordersList.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('order_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.orders.index") }}" class="nav-link {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-money-bill-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.order.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('order_payment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.order-payments.index") }}" class="nav-link {{ request()->is('admin/order-payments') || request()->is('admin/order-payments/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.orderPayment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('artist_response_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.artist-responses.index") }}" class="nav-link {{ request()->is('admin/artist-responses') || request()->is('admin/artist-responses/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-comment-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.artistResponse.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('payment_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/artist-payment-histories*') ? 'menu-open' : '' }} {{ request()->is('admin/agent-payment-histories*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-credit-card">

                            </i>
                            <p>
                                {{ trans('cruds.paymentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('artist_payment_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.artist-payment-histories.index") }}" class="nav-link {{ request()->is('admin/artist-payment-histories') || request()->is('admin/artist-payment-histories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-money-bill-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.artistPaymentHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('agent_payment_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.agent-payment-histories.index") }}" class="nav-link {{ request()->is('admin/agent-payment-histories') || request()->is('admin/agent-payment-histories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-money-bill-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.agentPaymentHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/categories*') ? 'menu-open' : '' }} {{ request()->is('admin/sub-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/tags*') ? 'menu-open' : '' }} {{ request()->is('admin/countries*') ? 'menu-open' : '' }} {{ request()->is('admin/languages*') ? 'menu-open' : '' }} {{ request()->is('admin/social-media*') ? 'menu-open' : '' }} {{ request()->is('admin/genders*') ? 'menu-open' : '' }} {{ request()->is('admin/occasions*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.contentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.categories.index") }}" class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.category.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sub_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sub-categories.index") }}" class="nav-link {{ request()->is('admin/sub-categories') || request()->is('admin/sub-categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cog">

                                        </i>
                                        <p>
                                            {{ trans('cruds.subCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tags.index") }}" class="nav-link {{ request()->is('admin/tags') || request()->is('admin/tags/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fab fa-500px">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('country_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.countries.index") }}" class="nav-link {{ request()->is('admin/countries') || request()->is('admin/countries/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-flag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.country.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('language_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.languages.index") }}" class="nav-link {{ request()->is('admin/languages') || request()->is('admin/languages/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fab fa-adn">

                                        </i>
                                        <p>
                                            {{ trans('cruds.language.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('social_medium_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.social-media.index") }}" class="nav-link {{ request()->is('admin/social-media') || request()->is('admin/social-media/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon far fa-address-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.socialMedium.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('gender_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.genders.index") }}" class="nav-link {{ request()->is('admin/genders') || request()->is('admin/genders/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.gender.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('occasion_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.occasions.index") }}" class="nav-link {{ request()->is('admin/occasions') || request()->is('admin/occasions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.occasion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('site_log_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/search-logs*') ? 'menu-open' : '' }} {{ request()->is('admin/login-logs*') ? 'menu-open' : '' }} {{ request()->is('admin/payment-logs*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-history">

                            </i>
                            <p>
                                {{ trans('cruds.siteLog.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('search_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.search-logs.index") }}" class="nav-link {{ request()->is('admin/search-logs') || request()->is('admin/search-logs/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-search">

                                        </i>
                                        <p>
                                            {{ trans('cruds.searchLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('login_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.login-logs.index") }}" class="nav-link {{ request()->is('admin/login-logs') || request()->is('admin/login-logs/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-sign-in-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.loginLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.payment-logs.index") }}" class="nav-link {{ request()->is('admin/payment-logs') || request()->is('admin/payment-logs/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-money-check-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.paymentLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('site_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/admin-settings*') ? 'menu-open' : '' }} {{ request()->is('admin/pages*') ? 'menu-open' : '' }} {{ request()->is('admin/email-subscriptions*') ? 'menu-open' : '' }} {{ request()->is('admin/promo-codes*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-align-justify">

                            </i>
                            <p>
                                {{ trans('cruds.siteManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('admin_setting_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.admin-settings.index") }}" class="nav-link {{ request()->is('admin/admin-settings') || request()->is('admin/admin-settings/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-sliders-h">

                                        </i>
                                        <p>
                                            {{ trans('cruds.adminSetting.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.pages.index") }}" class="nav-link {{ request()->is('admin/pages') || request()->is('admin/pages/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-book-open">

                                        </i>
                                        <p>
                                            {{ trans('cruds.page.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('email_subscription_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.email-subscriptions.index") }}" class="nav-link {{ request()->is('admin/email-subscriptions') || request()->is('admin/email-subscriptions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.emailSubscription.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('promo_code_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.promo-codes.index") }}" class="nav-link {{ request()->is('admin/promo-codes') || request()->is('admin/promo-codes/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-qrcode">

                                        </i>
                                        <p>
                                            {{ trans('cruds.promoCode.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>