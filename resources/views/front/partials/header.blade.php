<header>
    <div class="head-top container-fluid">
        <div class="contact">
            <span>{{ __('main.phone') }}: <a href="tel:{{ $settings['phone_fax'] }}">{{ $settings['phone_fax'] }}</a></span>
            <span>{{ __('main.email') }}: <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></span>
            <span>{{ __('main.address') }}: <a target="_blank" href="https://maps.google.com?saddr=Current+Location&daddr={{ $settings['geo_coordinates'] }}">{{ $settings[localeAppColumn('address')] }}</a></span>
        </div>
        <ul class="lang">
            <li class="{{ app()->getLocale() === 'ro' ? 'active' : '' }}"><a href="{{ route('setLocate', 'ro') }}">RO</a></li>
            <li class="{{ app()->getLocale() === 'en' ? 'active' : '' }}"><a href="{{ route('setLocate', 'en') }}">EN</a></li>
            <li class="{{ app()->getLocale() === 'ru' ? 'active' : '' }}"><a href="{{ route('setLocate', 'ru') }}">RU</a></li>
        </ul>
    </div>
    <div class="head-bottom container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="head-left">
                    <div class="top-catalog">
                        <div class="toggle"><span></span><span></span><span></span></div>
                        <span class="links">{{ __('header.categories') }}</span>
                    </div>
                    <div class="logo"><a href="{{ route('front.home') }}"><img src="{{ asset('front/images/logo.svg') }}" alt=""></a></div>

                    <form class="search" action="">
                        <input type="search" id="query_global_small" placeholder="{{ __('header.searching_docs') }}">
                        <button type="submit"></button>
                    </form>

                    <ul class="lang md-hidden">
                        <li class="{{ app()->getLocale() === 'ro' ? 'active' : '' }}"><a href="{{ route('setLocate', 'ro') }}">RO</a></li>
                        <li class="{{ app()->getLocale() === 'en' ? 'active' : '' }}"><a href="{{ route('setLocate', 'en') }}">EN</a></li>
                        <li class="{{ app()->getLocale() === 'ru' ? 'active' : '' }}"><a href="{{ route('setLocate', 'ru') }}">RU</a></li>
                    </ul>

                </div>
            </div>
            <div class="col-md-6">
                <div class="head-right">
                    <a class="md-hidden" href=""><img src="{{ asset('front/images/search.svg') }}" alt=""></a>
                    <a href="{{ route('profile.watch_later') }}"><span>{{ __('header.watch_later') }}</span><img src="{{ asset('front/images/clock.svg') }}" alt=""></a>
                    <a href="{{ route('profile.favourites') }}"><span>{{ __('header.favourites') }}</span><img src="{{ asset('front/images/bookmark.svg') }}" alt=""></a>

                    @include('front.partials.auth')

                </div>
            </div>
        </div>

        @include('front.partials.navigation')

    </div>
    <div class="head-nav container-fluid">
        <div class="toggle"><span></span><span></span><span></span></div>
        <ul>
            <li><a href="">{{ __('main.about_us') }}</a></li>
            <li><a href="{{ route('courses.index') }}">{{ __('main.electronic_courses') }}</a></li>
            <li><a href="{{ route('documents.index') }}">{{ __('main.info_materials') }}</a></li>
            <li><a href="{{ route('contacts.index') }}">{{ __('main.contacts') }}</a></li>
        </ul>
    </div>
</header>
