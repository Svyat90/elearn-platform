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
                                    <th>Data publicatii</th>
                                    <td>{{ $document->published_at }}</td>
                                </tr>
                                <tr>
                                    <th>Emitet</th>
                                    <td>{{ $document->{localeAppColumn('name_issuer')} }}</td>
                                </tr>
                                <tr>
                                    <th>Autor</th>
                                    <td>Institutul national al justitiei</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
{{--                                    <td><a href="">Justitie</a></td>--}}
                                    <td><a href="">{{ $document->{localeAppColumn('topic')} }}</a></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><a class="status" href="">{{ $document->status }}</a></td>
                                </tr>
                            </table>

                            <div class="doc-btn">
                                <a href="" class="button">Read now</a>
                                <a href="" class="button-white">Descarca PDF</a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/clock.svg') }}" alt=""> <span>Watch later</span></a>
                                <a href="" class="button-grey"><img src="{{ asset('front/images/bookmark.svg') }}" alt=""> <span>Add to favourits</span></a>
                            </div>
                        </div>
                        <div class="doc-bottom">
                            <div class="title">Descriere</div>
                            <p>{{ $document->description }}</p>
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
