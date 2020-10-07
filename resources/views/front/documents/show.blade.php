@extends('layouts.front')
@section('content')
    <main>

        @include('front.partials.breadcrumbs', ['breadcrumbs' => [
            ['name' => __('home.home'), 'link' => route('front.home')],
            ['name' => $document->{localeAppColumn('name')}],
        ]])

        <section class="container white">
            <div class="document">
                <div class="row">
                    <div class="document-img doc col-xs-12 col-sm-4 col-md-4">
                        <img src="{{ storageUrl($document->image_path, 'large') }}" alt="">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8">

                        <div class="doc-top">
                            <div class="title-section">{{ $document->{localeAppColumn('name')} }}</div>
                            <table class="atribute">
                                <tr>
                                    <th>{{ __('main.date_published') }}</th>
                                    <td>{{ $document->published_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.issuer') }}</th>
                                    <td>{{ $document->{localeAppColumn('name_issuer')} }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.author') }}</th>
                                    <td>{{ $document->{localeAppColumn('name_issuer')} }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.category') }}</th>
                                    <td>
                                        @foreach($document->categories as $category)
                                            <a href="{{ route('categories.show', $category->id) }}">{{ $category->{localeAppColumn('name')} }}</a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.status') }}</th>
                                    <td><a class="status" href="">{{ localeStatus($document->status) }}</a></td>
                                </tr>
                            </table>

                            <div class="doc-btn">
                                @php
                                    $isFavourite = in_array($document->id, $favouriteDocumentIds) ? true : false;
                                    $isWatchLater = in_array($document->id, $watchLaterDocumentIds) ? true : false;
                                @endphp
                                <a href="{{ storageUrl($document->file_path) }}" target="_blank" class="button">{{ __('main.read_now') }}</a>
                                <a href="{{ storageUrl($document->file_path) }}" class="button-white" download>{{ __('main.download_pdf') }}</a>
                                <a href="" class="button-grey document-watch-later" data-document-id="{{ $document->id }}" style="{{ $isWatchLater ? 'color: #970C13 !important; opacity: 1.0 !important;' : '' }}" >
                                    <img src="{{ asset('front/images/clock.svg') }}" alt="">
                                    <span>{{ __('main.watch_later') }}</span>
                                </a>
                                <a href="" class="button-grey document-favourite" data-document-id="{{ $document->id }}" style="{{ $isFavourite ? 'color: #970C13 !important; opacity: 1.0 !important;' : '' }}">
                                    <img src="{{ asset('front/images/bookmark.svg') }}" alt="">
                                    <span>{{ __('main.add_to_favourites') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="doc-bottom">
                            <div class="title">{{ __('main.description') }}</div>
                            <p>{!! $document->{localeAppColumn('description')} !!}</p>
                        </div>

                    </div>
                </div>


            </div>
        </section>

    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {

            enableWatchLaterDocument();
            enableFavouriteDocument();

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
             *  Show Login Modal
             */
            function showLogin()
            {
                let btnLogin = $(".login");
                btnLogin[0].click();
            }

        });
    </script>

@endsection
