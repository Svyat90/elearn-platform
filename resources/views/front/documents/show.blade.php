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
                        <img src="{{ storageUrl($document->image_path) }}" alt="">
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
                                <a href="{{ storageUrl($document->file_path) }}" target="_blank" class="button">{{ __('main.read_now') }}</a>
                                <a href="{{ storageUrl($document->file_path) }}" class="button-white" download>{{ __('main.download_pdf') }}</a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/clock.svg') }}" alt="">
                                    <span>{{ __('main.watch_later') }}</span>
                                </a>
                                <a href="" class="button-grey">
                                    <img src="{{ asset('front/images/bookmark.svg') }}" alt="">
                                    <span>{{ __('main.add_to_favourites') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="doc-bottom">
                            <div class="title">{{ __('main.description') }}</div>
                            <p>{{ $document->{localeAppColumn('description')} }}</p>
                        </div>

                    </div>
                </div>


            </div>
        </section>

    </main>
@endsection

@section('scripts')
    @parent
@endsection
