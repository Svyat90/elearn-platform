<footer>
    <div class="foot-top">
        <div class="logo"><a href=""><img src="{{ asset('front/images/logo.svg') }}" alt=""></a></div>
        <nav class="foot-nav">
            <ul>
                <li><a href="{{ $settings['about_us_link'] }}">{{ __('main.about_us') }}</a></li>
                <li><a href="{{ route('courses.index') }}">{{ __('main.electronic_courses') }}</a></li>
                <li><a href="{{ route('documents.index') }}">{{ __('main.info_materials') }}</a></li>
                <li><a href="{{ route('contacts.index') }}">{{ __('main.contacts') }}</a></li>
            </ul>
        </nav>
    </div>
    <div class="foot-bottom">
        <div class="container">
            <div class="copyright">{{ sprintf("©%s. %s %d %s", __('footer.сopyright'), config('app.name'), date('Y'), __('footer.all_rights_reserved')) }}</div>
            <div class="contact">
                <span>{{ __('main.phone') }}: <a href="tel:{{ $settings['phone_fax'] }}">{{ $settings['phone_fax'] }}</a></span>
                <span>{{ __('main.email') }}: <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></span>
                <span>{{ __('main.address') }}: <a target="_blank" href="https://maps.google.com?saddr=Current+Location&daddr={{ $settings['geo_coordinates'] }}">{{ $settings[localeAppColumn('address')] }}</a></span>
            </div>
        </div>
    </div>
</footer>
