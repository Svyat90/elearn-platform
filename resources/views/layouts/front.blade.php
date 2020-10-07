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
        let profileWatchLater = $("#profile_watch_later_header"),
            profileFavourites = $("#profile_favourites_header");

        checkAuthorizedGetRoute(profileWatchLater);
        checkAuthorizedGetRoute(profileFavourites);

        @if(Route::current()->getName() !== "documents.show")
            enableFavouriteDocument();
            enableWatchLaterDocument();
        @endif

        enableFavouriteCourse();
        enableWatchLaterCourse();

        enableGlobalSearch();

        /**
         *  Show Login Modal
         */
        function showLogin()
        {
            let btnLogin = $(".login");
            btnLogin[0].click();
        }

        /**
         *  Check login user before redirect
         */
        function checkAuthorizedGetRoute(object)
        {
            object.click(function (e) {
                e.preventDefault();
                let href = $(this).attr('href');
                $.ajax({
                    type: "GET",
                    url: href,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        window.location.href = href;
                    },
                    error: function (response) {
                        if (response.status === 401) {
                            showLogin();
                        }
                    }
                });
            });
        }

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
                        if (response.code === 403) {
                            showLogin();
                            return;
                        }

                        if (response.data.isFavorite === true) {
                            image.attr('src', '{{ favoriteImagePath(true) }}');
                        } else {
                            image.attr('src', '{{ favoriteImagePath(false) }}');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        let errors = response.responseJSON.errors;
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
                        if (response.code === 403) {
                            showLogin();
                            return;
                        }

                        if (response.data.isWatchLater === true) {
                            image.attr('src', '{{ watchLaterImagePath(true) }}');
                        } else {
                            image.attr('src', '{{ watchLaterImagePath(false) }}');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        let errors = response.responseJSON.errors;
                    }
                });
            });
        }

        /**
         * Global toggle favourite courses
         */
        function enableFavouriteCourse()
        {
            $(".course-favourite").click(function (e) {
                e.preventDefault();

                let courseId = $(this).data('course-id');
                let image = $(this).find('img');

                let formData = new FormData();
                formData.append('courseId', courseId);

                $.ajax({
                    type: "POST",
                    url: '{{ route('courses.favourite') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.code === 403) {
                            showLogin();
                            return;
                        }

                        if (response.data.isFavorite === true) {
                            image.parent().attr('style', 'color: #970C13 !important; opacity: 1.0 !important;');
                        } else {
                            image.parent().attr('style', '');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        let errors = response.responseJSON.errors;
                    }
                });
            });
        }

        /**
         * Global toggle watch later courses
         */
        function enableWatchLaterCourse()
        {
            $(".course-watch-later").click(function (e) {
                e.preventDefault();

                let courseId = $(this).data('course-id');
                let image = $(this).find('img');

                let formData = new FormData();
                formData.append('courseId', courseId);

                $.ajax({
                    type: "POST",
                    url: '{{ route('courses.watch_later') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.code === 403) {
                            showLogin();
                            return;
                        }

                        if (response.data.isWatchLater === true) {
                            image.parent().attr('style', 'color: #970C13 !important; opacity: 1.0 !important;');
                        } else {
                            image.parent().attr('style', '');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        let errors = response.responseJSON.errors;
                    }
                });
            });
        }

        /**
         * Global enable smart search
         */
        function enableGlobalSearch()
        {
            let searchContainer = $(".search-box"),
                formFiltersGlobal = $("#search_filters_global"),
                formSearchGlobal = $("#search_form"),
                formSubmitSearchGlobal = $("#submit_search_form"),
                filterAllGlobal = $("#filter_all_global"),
                filterIssuerGlobal = $("#filter_issuer_global"),
                filterNameGlobal = $("#filter_name_global"),
                filterDescriptionGlobal = $("#filter_description_global"),
                filterContentGlobal = $("#filter_content_global"),
                inputQueryGlobalSmall = $("#query_global_small"),
                inputQueryGlobalBig = $("#query_global_big"),
                inputQueryGlobalHidden = $("#query_global_hidden"),
                searchResultsContainer = $(".search-view").first();

            let filters = {};

            filters.filter_all = 0;
            filters.filter_issuer = 0;
            filters.filter_name = 0;
            filters.filter_description = 0;
            filters.filter_content = 0;

            filterAllGlobal.change(function (e) {
                handleFormFilterGlobal($(this), 'filter_all');
            })

            filterIssuerGlobal.change(function (e) {
                handleFormFilterGlobal($(this), 'filter_issuer');
            })

            filterNameGlobal.change(function (e) {
                handleFormFilterGlobal($(this), 'filter_name');
            })

            filterDescriptionGlobal.change(function (e) {
                handleFormFilterGlobal($(this), 'filter_description');
            })

            filterContentGlobal.change(function (e) {
                handleFormFilterGlobal($(this), 'filter_content');
            })

            inputQueryGlobalBig.on("input", function(){
                let query = $(this).val();
                if (query.length === 0) {
                    searchContainer.hide();
                    inputQueryGlobalSmall.val("");

                } else {
                    sendAjaxSearchRequest();
                }
            });

            inputQueryGlobalSmall.on("input", function(){
                inputQueryGlobalBig.val($(this).val());
                searchContainer.show();
                sendAjaxSearchRequest();
            });

            formSearchGlobal.submit(function (e) {
                e.preventDefault();
                formFiltersGlobal.submit();
            });

            formSubmitSearchGlobal.submit(function (e) {
                e.preventDefault();
                let query = inputQueryGlobalSmall.val();
                inputQueryGlobalHidden.val(query);
                formFiltersGlobal.submit();
            });

            /**
             *
             * @param object
             * @param name
             */
            function handleFormFilterGlobal(object, name)
            {
                let checked = object.prop('checked') ? 1 : 0;
                object.val(checked);
                filters[name] = checked;
                sendAjaxSearchRequest();
            }

            function sendAjaxSearchRequest()
            {
                let route = '{{ route('documents.index') }}';
                let imageDoc = '{{ asset('front/images/doc.svg') }}';
                let searchNoResults = '{{ __('search.no_results') }}';

                let query = inputQueryGlobalBig.val();
                inputQueryGlobalHidden.val(query);
                if (query.length === 0) {
                    searchResultsContainer.empty();
                    return;
                }

                let formData = new FormData();
                formData.append('query', query);
                formData.append('filter_all', filters.filter_all);
                formData.append('filter_issuer', filters.filter_issuer);
                formData.append('filter_name', filters.filter_name);
                formData.append('filter_description', filters.filter_description);
                formData.append('filter_content', filters.filter_content);

                $.ajax({
                    type: "POST",
                    url: '{{ route('search') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        searchResultsContainer.empty();
                        if (response.data.length > 0) {
                            response.data.forEach(function (item) {
                                let insertItem = '<a href="' + route + '/' + item.id + '"><img src="' + imageDoc + '" alt="">' + item.name + '</a>';
                                searchResultsContainer.append(insertItem);
                            });

                        } else {
                            searchResultsContainer.append('<span>' + searchNoResults + '</span>');
                        }
                    },
                    error: function (response) {
                        console.log('error', response);
                    }
                });
            }

            $('.close').on('click', function () {
                $(this).parents('.search-box').hide();
            });

        }
    });
</script>

</body>
</html>
