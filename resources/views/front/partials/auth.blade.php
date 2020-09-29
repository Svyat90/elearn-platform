@if( ! Auth::user())
    @include('front.partials.modals.login')
    @include('front.partials.modals.registration')
    <a class="login" href="#login">{{ __('auth.login') }}</a>
    <a href="#reg" class="button">{{ __('auth.register') }}</a>
@else
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <div class="my-account"><span>{{ __('profile.my_account') }} <img src="{{ asset('front/images/down.svg') }}" alt=""></span>
        <ul>
            <li class="{{ request()->is('profile/personal_data') ? 'active' : '' }}">
                <a href="{{ route('profile.my_account') }}"><img src="{{ asset('front/images/user.svg') }}" alt="">{{ __('profile.personal_data') }}</a>
            </li>
            <li class="{{ request()->is('profile/favourites') ? 'active' : '' }}">
                <a href="{{ route('profile.favourites') }}"><img src="{{ asset('front/images/bookmark.svg') }}" alt="">{{ __('profile.favourites') }}</a>
            </li>
            <li class="{{ request()->is('profile/watch_later') ? 'active' : '' }}">
                <a href="{{ route('profile.watch_later') }}"><img src="{{ asset('front/images/clock.svg') }}" alt="">{{ __('profile.watch_later') }}</a>
            </li>
            <li class="{{ request()->is('profile/my_courses') ? 'active' : '' }}">
                <a href="{{ route('profile.my_courses') }}"><img src="{{ asset('front/images/book.svg') }}" alt="">{{ __('profile.my_courses') }}</a>
            </li>
            <li class="{{ request()->is('profile/my_documents') ? 'active' : '' }}">
                <a href="{{ route('profile.my_documents') }}"><img src="{{ asset('front/images/doc.svg') }}" alt="">{{ __('profile.my_documents') }}</a>
            </li>
            <li><a id="logout-btn" href="#"><img src="{{ asset('front/images/log.svg') }}" alt="">{{ __('auth.logout') }}</a></li>
        </ul>
    </div>
@endif

@section('scripts')
<script>
    $(function () {
        // *** Login *** //
        let email = $('input[name="email"]');
        let password = $('input[name="password"]');
        let loginUrl = '{{ route('login') }}'
        let loginErrors = $('#login-errors');

        $('form[name="login"]').submit(function (e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('email', email.val());
            formData.append('password', password.val());
            formData.append('locale', '{{ app()->getLocale() }}');

            $.ajax({
                type: "POST",
                url: loginUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    loginErrors.hide().empty();
                    window.location.href = '{{ route('front.home') }}';
                },
                error: function (response) {
                    loginErrors.hide().empty();
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        loginErrors.append('<strong>' + value + '</strong><br>')
                    });
                    loginErrors.show();
                }
            });
        })

        // *** Logout *** //
        $("#logout-btn").on('click', function (e) {
            e.preventDefault();
            $("#logout-form").submit();
        });

        // *** Register *** //
        let emailRegister = $('input[name="email-register"]');
        let passwordRegister = $('input[name="password-register"]');
        let confirmPasswordRegister = $('input[name="confirm-password-register"]');
        let registerUrl = '{{ route('register') }}'
        let registerErrors = $('#register-errors');

        $('form[name="register"]').submit(function (e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('email', emailRegister.val());
            formData.append('password', passwordRegister.val());
            formData.append('password_confirmation', confirmPasswordRegister.val());
            formData.append('locale', '{{ app()->getLocale() }}');

            $.ajax({
                type: "POST",
                url: registerUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    registerErrors.hide().empty();
                    window.location.href = '{{ route('front.home') }}';
                },
                error: function (response) {
                    registerErrors.hide().empty();
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        registerErrors.append('<strong>' + value + '</strong><br>')
                    });
                    registerErrors.show();
                }
            });
        })
    });
</script>
@endsection
