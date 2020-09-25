<header>
    <div class="head-top container-fluid">
        <div class="contact">
            <span>{{ __('main.phone') }}: <a href="tel:+373859495">+373 85 94 95</a></span>
            <span>{{ __('main.email') }}: <a href="mailto:e-learning@gmail.com">e-learning@gmail.com</a></span>
            <span>{{ __('main.address') }}: <a href="https://maps.google.com?saddr=Current+Location&daddr=47.025007,28.818153">MD 2004, Republica Moldova, Chișinău, str. S.Lazo, 1</a></span>
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
                    <div class="logo"><a href="/"><img src="{{ asset('front/images/logo.svg') }}" alt=""></a></div>

                    <form class="search" action="">
                        <input type="search" placeholder="{{ __('header.searching_docs') }}">
                        <button type="submit"></button>
                    </form>

                    <ul class="lang md-hidden">
                        <li><a href="">RO</a></li>
                        <li class="active"><a href="">EN</a></li>
                    </ul>

                </div>
            </div>
            <div class="col-md-6">
                <div class="head-right">
                    <a class="md-hidden" href=""><img src="{{ asset('front/images/search.svg') }}" alt=""></a>
                    <a href=""><span>{{ __('header.watch_later') }}</span><img src="{{ asset('front/images/clock.svg') }}" alt=""></a>
                    <a href=""><span>{{ __('header.favourites') }}</span><img src="{{ asset('front/images/bookmark.svg') }}" alt=""></a>

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
            <li><a href="">{{ __('main.contacts') }}</a></li>
        </ul>
    </div>
</header>
