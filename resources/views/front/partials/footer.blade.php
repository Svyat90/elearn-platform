<footer>
    <div class="foot-top">
        <div class="logo"><a href=""><img src="{{ asset('front/images/logo.svg') }}" alt=""></a></div>
        <nav class="foot-nav">
            <ul>
                <li><a href="">{{ __('main.about_us') }}</a></li>
                <li><a href="">{{ __('main.electronic_courses') }}</a></li>
                <li><a href="">{{ __('main.info_materials') }}</a></li>
                <li><a href="">{{ __('main.contacts') }}</a></li>
            </ul>
        </nav>
    </div>
    <div class="foot-bottom">
        <div class="container">
            <div class="copyright">{{ sprintf("©%s. %s %d %s", __('footer.сopyright'), config('app.name'), date('Y'), __('footer.all_rights_reserved')) }}</div>
            <div class="contact">
                <span>{{ __('main.phone') }}: <a href="tel:+373859495">+373 85 94 95</a></span>
                <span>{{ __('main.email') }}: <a href="mailto:e-learning@gmail.com">e-learning@gmail.com</a></span>
                <span>{{ __('main.address') }}: <a href="https://maps.google.com?saddr=Current+Location&daddr=47.025007,28.818153">MD 2004, Republica Moldova, Chișinău, str. S.Lazo, 1</a></span>
            </div>
        </div>
    </div>
</footer>
