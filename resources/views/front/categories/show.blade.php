@extends('layouts.front')
@section('content')
    <main>

        @include('front.partials.breadcrumbs', ['breadcrumbs' => [
            ['name' => __('home.home'), 'link' => route('front.home')],
            ['name' => $category->{localeAppColumn('name')}],
        ]])

        <section class="container white">
            <div class="category-top">
                <img src="{{ categoryImagePath($category->id) }}" alt="">
                <div class="title-section">{{ $category->{localeAppColumn('name')} }}</div>
            </div>
        </section>

        <section class="container category-filter white">
            <div class="filter">
                <div class="row">
                    <form name="document_filters" action="{{ route('categories.show', $category->id) }}" method="get">

                        <div class="filter-box col-sm-4">
                            <select name="filter_type" id="filter_document">
                                <option value="" selected>{{ __('category.all_types_documents') }}</option>
                                @php $filterType = request()->get('filter_type') ?? null; @endphp
                                @foreach($allTypes as $type)
                                    <option value="{{ $type }}" {{ $filterType && $filterType === $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-box col-sm-4">
                            <select name="filter_issuer" id="filter_issuer">
                                <option value="" selected>{{ __('category.all_types_issuers') }}</option>
                                @php $filterIssuer = request()->get('filter_issuer') ?? null; @endphp
                                @foreach($allIssuers as $issuer)
                                    <option value="{{ $issuer }}" {{ $filterIssuer && $filterIssuer === $issuer ? 'selected' : '' }}>{{ $issuer }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-box col-sm-4">
                            <select name="filter_topic" id="filter_topic">
                                <option value="" selected>{{ __('category.all_types_topic') }}</option>
                                @php $filterTopic = request()->get('filter_topic') ?? null; @endphp
                                @foreach($allTopics as $topic)
                                    <option value="{{ $topic }}" {{ $filterTopic && $filterTopic === $topic ? 'selected' : '' }}>{{ $topic }}</option>
                                @endforeach
                            </select>
                        </div>

                    </form>
                </div>
            </div>
        </section>

        @if(count($documents) > 0)
            <section class="container white">
                <div class="grid">
                    <div class="row">
                        @foreach($documents as $document)
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                @include('front.documents._item', ['document' => $document])
                            </div>
                        @endforeach
                    </div>

                    {{ $documents->links('front.partials.paginator') }}

                </div>
            </section>
        @else
            <section class="container no-search">
                <div class="title-section">{{ __('search.no_results') }}</div>
            </section>
        @endif

    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let formFilters = $('form[name="document_filters"]'),
                selectType = $('select[name="filter_type"]'),
                selectIssuer = $('select[name="filter_issuer"]'),
                selectTopic = $('select[name="filter_topic"]');

            selectType.change(function (e) {
                formFilters.submit();
            })

            selectIssuer.change(function (e) {
                formFilters.submit();
            })

            selectTopic.change(function (e) {
                formFilters.submit();
            })

        });
    </script>
@endsection
