@extends('layouts.front')
@section('content')
    <main>
        <section class="container home-top">
            <h1 class="title-site">{{ __('home.title') }}</h1>
        </section>

        <section class="home-one container">
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-xs-6 col-md-4">
                        @include('front.courses._item', ['course' => $course])
                    </div>
                @endforeach
            </div>
        </section>

        <div class="title-section container">{{ __('home.education') }}</div>

        <section class="home-two white container">
            <div class="row">
                @foreach($documentsEducation as $document)
                    <div class="col-md-6">
                        <div class="educ row">
                            <div class="images col-xs-4">
                                <div class="top-book">
                                    <a href=""><img src="{{ asset('front/images/clock-white.svg') }}" alt=""></a>
                                    <a href=""><img src="{{ asset('front/images/bookmark-white.svg') }}" alt=""></a>
                                </div>
                                <a href="{{ route('documents.show', $document->id) }}"><img src="{{ storageUrl($document->image_path) }}" alt=""></a>
                            </div>
                            <div class="caption col-xs-8">
                                <div class="text">
                                    <a href="" class="title">{{ __('home.education') }}</a>
                                    <p>{{ $document->{localeAppColumn('name')} }}</p>
                                </div>
                                <div class="meta">
                                    <div class="date">{{ $document->published_at }}</div>
                                    <a href="" class="more">{{ __('main.read_more') }} <img src="{{ asset('front/images/down.svg') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="title-section container">{{ __('home.category') }}</div>

        <section class="home-three container">
            <div class="row">
                @foreach($categoriesForWidget as $category)
                    <div class="col-xs-6 col-md-3">
                        <div class="cat">
                            <a href="{{ route('categories.show', $category->id) }}">
                                <div class="ico"><img src="{{ categoryImagePath($category->id) }}" alt=""></div>
                                <span class="title">{{ $category->{localeAppColumn('name')} }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="title-section container">{{ __('home.most_popular') }}</div>

        <section class="home-for white container">
            <div id="popular" class="owl-carousel">
                @foreach($documentsMostPopular as $document)
                    <div class="item">
                        @include('front.documents._item', ['document' => $document])
                    </div>
                @endforeach
            </div>
        </section>

    </main>
@endsection

@section('scripts')
    @parent
@endsection
