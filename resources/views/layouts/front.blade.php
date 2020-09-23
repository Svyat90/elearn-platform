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

@yield('scripts')

</body>
</html>
