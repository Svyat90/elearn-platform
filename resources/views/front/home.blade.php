@extends('layouts.front')
@section('content')
    <main>
        <section class="container home-top">
            <h1 class="title-site">{{ __('home.title') }}</h1>
        </section>

        <section class="home-one container">
            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <div class="cours">
                        <a class="course-img" href=""><img src="{{ asset('front/images/cours.jpg') }}" alt=""></a>
                        <div class="caption">
                            <div class="meta">
                                <a href="">Psihologie</a>
                                <div class="date">11.03.2020</div>
                            </div>
                            <p>Specificul psihologic şi particularităţile audierii victimelor traficului de fiinţe
                                umane</p>
                            <div class="course-but">
                                <a href="" class="more">{{ __('main.read_more') }} <img src="{{ asset('front/images/down.svg') }}" alt=""></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/clock.svg') }}" alt="">
                                    <span>{{ __('main.watch_later') }}</span></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/bookmark.svg') }}" alt=""> <span>{{ __('main.add_to_favourites') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="cours">
                        <a class="course-img" href=""><img src="{{ asset('front/images/cours.jpg') }}" alt=""></a>
                        <div class="caption">
                            <div class="meta">
                                <a href="">Psihologie</a>
                                <div class="date">11.03.2020</div>
                            </div>
                            <p>Specificul psihologic şi particularităţile audierii victimelor traficului de fiinţe
                                umane</p>
                            <div class="course-but">
                                <a href="" class="more">{{ __('main.read_more') }} <img src="{{ asset('front/images/down.svg') }}" alt=""></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/clock.svg') }}" alt="">
                                    <span>{{ __('main.watch_later') }}</span></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/bookmark.svg') }}" alt=""> <span>{{ __('main.add_to_favourites') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="cours">
                        <a class="course-img" href=""><img src="{{ asset('front/images/cours.jpg') }}" alt=""></a>
                        <div class="caption">
                            <div class="meta">
                                <a href="">Psihologie</a>
                                <div class="date">11.03.2020</div>
                            </div>
                            <p>Specificul psihologic şi particularităţile audierii victimelor traficului de fiinţe
                                umane</p>
                            <div class="course-but">
                                <a href="" class="more">{{ __('main.read_more') }} <img src="{{ asset('front/images/down.svg') }}" alt=""></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/clock.svg') }}" alt="">
                                    <span>{{ __('main.watch_later') }}</span></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/bookmark.svg') }}" alt=""> <span>{{ __('main.add_to_favourites') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>

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

                <div class="col-xs-6 col-md-3">
                    <div class="cat">
                        <a href="">
                            <div class="ico"><img src="{{ asset('front/images/cat-img-1.png') }}" alt=""></div>
                            <span class="title">Actele normative</span>
                        </a>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="cat">
                        <a href="">
                            <div class="ico"><img src="{{ asset('front/images/cat-img-2.png') }}" alt=""></div>
                            <span class="title">Actele legate de evaluările (continue/finale)</span>
                        </a>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="cat">
                        <a href="">
                            <div class="ico"><img src="{{ asset('front/images/cat-img-3.png') }}" alt=""></div>
                            <span class="title">Materialele metodico-didactice elaborate în cadrul instruirilorinițiale și continue</span>
                        </a>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="cat">
                        <a href="">
                            <div class="ico"><img src="{{ asset('front/images/cat-img-4.png') }}" alt=""></div>
                            <span class="title">Materialele de cercetare</span>
                        </a>
                    </div>
                </div>

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
