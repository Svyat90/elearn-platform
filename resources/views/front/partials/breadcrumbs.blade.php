<section class="breadcrumbs container">
    @foreach($breadcrumbs as $key => $breadcrumb)
        @if(empty($breadcrumb['link']))
            <span>{{ $breadcrumb['name'] }}</span>
        @else
            <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a>
        @endif
    @endforeach
</section>
