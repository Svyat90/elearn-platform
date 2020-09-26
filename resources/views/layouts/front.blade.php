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

<script>
    $(function () {
        enableFavouriteDocument();
        enableWatchLaterDocument();

        /**
         * Global toggle favourite documents
         */
        function enableFavouriteDocument()
        {
            $(".document-favourite").click(function (e) {
                e.preventDefault();

                let documentId = $(this).data('document-id');
                let image = $(this).find('img');

                let formData = new FormData();
                formData.append('documentId', documentId);

                $.ajax({
                    type: "POST",
                    url: '{{ route('documents.favourite') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.data.isFavorite === true) {
                            image.attr('src', '{{ favoriteImagePath(true) }}');
                        } else {
                            image.attr('src', '{{ favoriteImagePath(false) }}');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        let errors = response.responseJSON.errors;
                        alert(errors);
                    }
                });
            });
        }

        /**
         * Global toggle watch later documents
         */
        function enableWatchLaterDocument()
        {
            $(".document-watch-later").click(function (e) {
                e.preventDefault();

                let documentId = $(this).data('document-id');
                let image = $(this).find('img');

                let formData = new FormData();
                formData.append('documentId', documentId);

                $.ajax({
                    type: "POST",
                    url: '{{ route('documents.watch_later') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.data.isWatchLater === true) {
                            image.attr('src', '{{ watchLaterImagePath(true) }}');
                        } else {
                            image.attr('src', '{{ watchLaterImagePath(false) }}');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        let errors = response.responseJSON.errors;
                        alert(errors);
                    }
                });
            });
        }
    });
</script>

</body>
</html>
