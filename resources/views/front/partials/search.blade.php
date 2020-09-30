<div class="search-box">
    <div class="container">
        <div class="close"></div>
        <div class="filter">

            <form name="search_filters" id="search_filters" action="{{ route('documents.index') }}" method="get">
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
            </form>
        </div>

        <form name="search_form" id="search_form" class="search" action="">
            <input name="query" type="search" id="query_global_big" placeholder="{{ __('header.searching_docs') }}" value="{{ request()->get('query') }}">
            <button type="submit"></button>
        </form>

        <div class="search-view">
            <a href=""><img src="{{ asset('front/images/images/doc.svg') }}" alt=""> Specificul <b>psihologic</b> şi particularităţile audierii
                victimelor traficului de fiinţe umane </a>
            <a href=""><img src="{{ asset('front/images/images/book.svg') }}" alt=""> Specificul psihologic şi particularităţile audierii
                victimelor traficului de fiinţe umane </a>
            <a href=""><img src="{{ asset('front/images/images/doc.svg') }}" alt=""> Specificul psihologic şi particularităţile audierii
                victimelor traficului de fiinţe umane </a>
            <a href=""><img src="{{ asset('front/images/images/clock.svg') }}" alt=""> Specificul psihologic şi particularităţile audierii
                victimelor traficului de fiinţe umane </a>
            <a href=""><img src="{{ asset('front/images/images/user.svg') }}" alt=""> Specificul psihologic şi particularităţile audierii
                victimelor traficului de fiinţe umane </a>
            <a href=""><img src="{{ asset('front/images/images/doc.svg') }}" alt=""> Specificul psihologic şi particularităţile audierii
                victimelor traficului de fiinţe umane </a>
            <a href=""><img src="{{ asset('front/images/images/doc.svg') }}" alt=""> Specificul psihologic şi particularităţile audierii
                victimelor traficului de fiinţe umane </a>
        </div>

    </div>
</div>
