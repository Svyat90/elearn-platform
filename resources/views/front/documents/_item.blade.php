<div class="book">
    <div class="top-book">
        <a href=""><img src="{{ asset('front/images/clock-white.svg') }}" alt=""></a>
        <a href=""><img src="{{ asset('front/images/bookmark-white.svg') }}" alt=""></a>
    </div>
    <a href="{{ route('documents.show', $document->id) }}"><img src="{{ storageUrl($document->image_path) }}" alt="">
        <p>{{ $document->{localeAppColumn('name')} }}</p>
    </a>
</div>
