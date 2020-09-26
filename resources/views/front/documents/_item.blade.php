@php
    $isFavourite = in_array($document->id, $favouriteDocumentIds) ? true : false;
    $isWatchLater = in_array($document->id, $watchLaterDocumentIds) ? true : false;
@endphp

<div class="book">
    <div class="top-book">
        <a href="" class="document-watch-later" data-document-id="{{ $document->id }}">
            <img src="{{ watchLaterImagePath($isWatchLater) }}" alt="">
        </a>
        <a href="" class="document-favourite" data-document-id="{{ $document->id }}">
            <img src="{{ favoriteImagePath($isFavourite) }}" alt="">
        </a>
    </div>
    <a href="{{ route('documents.show', $document->id) }}"><img src="{{ storageUrl($document->image_path) }}" alt="">
        <p>{{ $document->{localeAppColumn('name')} }}</p>
    </a>
</div>
