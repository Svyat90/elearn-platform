<div class="search-box">
    <div class="container">
        <div class="close"></div>
        <div class="filter">

            <form name="search_filters_global" id="search_filters_global" action="{{ route('documents.index') }}" method="get">
                <input name="query" id="query_global_hidden" type="hidden" value="{{ request()->get('query') }}" />
                <label class="check-l" for="filter_all">
                    @php $filterAll = request()->get('filter_all') ?? null; @endphp
                    <input name="filter_all" id="filter_all_global" class="check" type="checkbox" {{ $filterAll && $filterAll === "1" ? 'checked' : '' }} value="{{ $filterAll }}">
                    {{ __('search.all') }}
                </label>
                <label class="check-l" for="filter_issuer">
                    @php $filterIssuer = request()->get('filter_issuer') ?? null; @endphp
                    <input class="check" type="checkbox" name="filter_issuer" id="filter_issuer_global" {{ $filterIssuer && $filterIssuer === "1" ? 'checked' : '' }} value="{{ $filterIssuer }}">
                    {{ __('search.by_issuer') }}
                </label>
                <label class="check-l" for="filter_name">
                    @php $filterName = request()->get('filter_name') ?? null; @endphp
                    <input class="check" type="checkbox" name="filter_name" id="filter_name_global" {{ $filterName && $filterName === "1" ? 'checked' : '' }} value="{{ $filterName }}">
                    {{ __('search.by_name') }}
                </label>
                <label class="check-l" for="filter_description">
                    @php $filterDesc = request()->get('filter_description') ?? null; @endphp
                    <input class="check" type="checkbox" name="filter_description" id="filter_description_global" {{ $filterDesc && $filterDesc === "1" ? 'checked' : '' }} value="{{ $filterDesc }}">
                    {{ __('search.by_description') }}
                </label>
                <label class="check-l"  for="filter_content">
                    @php $filterContent = request()->get('filter_content') ?? null; @endphp
                    <input class="check" type="checkbox" name="filter_content" id="filter_content_global" {{ $filterContent && $filterContent === "1" ? 'checked' : '' }} value="{{ $filterContent }}">
                    {{ __('search.by_content') }}
                </label>
            </form>
        </div>

        <form name="search_form" id="search_form" class="search" action="">
            <input name="query" type="search" id="query_global_big" placeholder="{{ __('header.searching_docs') }}" value="{{ request()->get('query') }}">
            <button type="submit"></button>
        </form>

        <div class="search-view">

        </div>

    </div>
</div>
