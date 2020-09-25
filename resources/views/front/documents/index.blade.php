@extends('layouts.front')
@section('content')
    <main>

        @include('front.partials.breadcrumbs', ['breadcrumbs' => [
            ['name' => __('home.home'), 'link' => route('front.home')],
            ['name' => __('main.documents')],
        ]])

        @if(count($documents) > 0)
            <section class="container">
                <div class="grid">
                    <div class="row">
                        @foreach($documents as $document)
                            <div class="col-xs-6 col-md-4">
                                @include('front.documents._item', ['document' => $document])
                            </div>
                        @endforeach
                    </div>

                    {{ $documents->links('front.partials.paginator') }}

                </div>
            </section>
        @else
            <section class="container no-search">
                <div class="title-section">{{ __('main.not_found_available_document') }}</div>
            </section>
        @endif

    </main>
@endsection

@section('scripts')
    @parent
@endsection
