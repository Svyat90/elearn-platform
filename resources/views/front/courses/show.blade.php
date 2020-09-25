@extends('layouts.front')
@section('content')
    <main>
        <section class="container white">
            <div class="document">
                <div class="row">
                    <div class="document-img col-md-4">
                        <img src="{{ storageUrl($course->image_path) }}" alt="">

                        <div class="contents">
                            <div class="contents-list">
                                <div class="title">{{ __('main.documents') }}</div>
                                <ol class="list_all">
                                    @foreach($documents as $document)
                                        <li><span>{{ $document->{localeAppColumn('name')} }}</span></li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="doc-top">
                            <div class="title-section">{{ $course->{localeAppColumn('name')} }}</div>
                            <table class="atribute">
                                <tr>
                                    <th>{{ __('main.date_published') }}</th>
                                    <td>{{ $course->published_At }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.issuer') }}</th>
                                    <td>{{ $course->{localeAppColumn('name_issuer')} }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.author') }}</th>
                                    <td>{{ $course->{localeAppColumn('name_issuer')} }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.category') }}</th>
                                    <td>
                                        @foreach($course->categories as $category)
                                            <a href="{{ route('categories.show', $category->id) }}">{{ $category->{localeAppColumn('name')} }}</a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('main.status') }}</th>
                                    <td><a class="status" href="">Modificat</a></td>
                                </tr>
                            </table>

                            <div class="doc-btn">
                                <a href="" class="button-grey"><img src="{{ asset('front/images/clock.svg') }}" alt=""> <span>{{ __('main.watch_later') }}</span></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/bookmark.svg') }}" alt=""> <span>{{ __('main.add_to_favourites') }}</span></a>
                            </div>
                        </div>
                        <div class="doc-bottom">
                            <div class="title">{{ __('main.description') }}</div>
                            <p>{{ $course->description }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="grid">
                <div class="title-section">{{ __('main.documents') }}</div>
                <div class="row">
                    @foreach($documents as $document)
                        <div class="col-xs-6 col-sm-4 col-md-3">
                            @include('front.documents._item', ['document' => $document])
                        </div>
                    @endforeach
                </div>

                <div class="pagination">
                    <!---->
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    @parent
@endsection
