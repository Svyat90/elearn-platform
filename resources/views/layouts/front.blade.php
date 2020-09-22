<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acasă</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('front/css/jquery.formstyler.css') }}" rel="stylesheet"/>
    <link href="{{ asset('front/css/jquery.formstyler.theme.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" rel="stylesheet"/>
    <link href="{{ asset('front/css/bootstrap.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('front/css/style.css') }}" type="text/css" rel="stylesheet">

    @yield('styles')
</head>
<body>
<div class="wrapper">
    @include('front.partials.search')

    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')
</div>

<!-- Script-->
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
<script src="{{ asset('front/js/jquery.formstyler.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.jscrollpane.min.js') }}"></script>
<script src="{{ asset('front/js/app.js') }}"></script>

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
                        loginErrors.append('<strong>' + value + '</strong>')
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
                        registerErrors.append('<strong>' + value + '</strong>')
                    });
                    registerErrors.show();
                }
            });
        })
    });
</script>

@yield('scripts')

</body>
</html>
