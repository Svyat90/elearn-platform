@extends('layouts.front')
@section('content')
    <main>

        @include('front.partials.breadcrumbs', ['breadcrumbs' => [
            ['name' => __('home.home'), 'link' => route('front.home')],
            ['name' => __('main.documents')],
        ]])

        @if(request()->get('query'))
            <section class="container category-filter white">
                <form name="search_filters" action="{{ route('documents.index') }}" method="get">
                    <div class="filter">
                        <input name="query" id="query" type="hidden" value="{{ request()->get('query') ?? '' }}" />
                        <div class="title-section">{{ __('search.search') }} : “{{ request()->get('query') }}”</div>
                        <label class="check-l" for="filter_all">
                            @php $filterAll = request()->get('filter_all') ?? null; @endphp
                            <input name="filter_all" id="filter_all" class="check" type="checkbox" {{ $filterAll && $filterAll === "1" ? 'checked' : '' }} value="{{ $filterAll }}">
                            {{ __('search.all') }}
                        </label>
                        <label class="check-l" for="filter_issuer">
                            @php $filterIssuer = request()->get('filter_issuer') ?? null; @endphp
                            <input class="check" type="checkbox" name="filter_issuer" id="filter_issuer" {{ $filterIssuer && $filterIssuer === "1" ? 'checked' : '' }} value="{{ $filterIssuer }}">
                            {{ __('search.by_issuer') }}
                        </label>
                        <label class="check-l" for="filter_name">
                            @php $filterName = request()->get('filter_name') ?? null; @endphp
                            <input class="check" type="checkbox" name="filter_name" id="filter_name" {{ $filterName && $filterName === "1" ? 'checked' : '' }} value="{{ $filterName }}">
                            {{ __('search.by_name') }}
                        </label>
                        <label class="check-l" for="filter_description">
                            @php $filterDesc = request()->get('filter_description') ?? null; @endphp
                            <input class="check" type="checkbox" name="filter_description" id="filter_description" {{ $filterDesc && $filterDesc === "1" ? 'checked' : '' }} value="{{ $filterDesc }}">
                            {{ __('search.by_description') }}
                        </label>
                        <label class="check-l"  for="filter_content">
                            @php $filterContent = request()->get('filter_content') ?? null; @endphp
                            <input class="check" type="checkbox" name="filter_content" id="filter_content" {{ $filterContent && $filterContent === "1" ? 'checked' : '' }} value="{{ $filterContent }}">
                            {{ __('search.by_content') }}
                        </label>
                    </div>
                </form>
            </section>
        @endif

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
                <div class="title-section">{{ __('main.not_found_available_document') }}</div>
            </section>
        @endif

    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let formFilters = $("#search_filters"),
                filterAll = $("#filter_all"),
                filterIssuer = $("#filter_issuer"),
                filterName = $("#filter_name"),
                filterDescription = $("#filter_description"),
                filterContent = $("#filter_content");

            filterAll.change(function (e) {
                handleFormFilter($(this));x
            })

            filterIssuer.change(function (e) {
                handleFormFilter($(this));
            })

            filterName.change(function (e) {
                handleFormFilter($(this));
            })

            filterDescription.change(function (e) {
                handleFormFilter($(this));
            })

            filterContent.change(function (e) {
                handleFormFilter($(this));
            })

            /**
             * @param object
             */
            function handleFormFilter(object)
            {
                let checked = object.prop('checked') ? 1 : 0;
                object.val(checked);
                formFilters.submit();
            }

        });
    </script>
@endsection
