@php
    $isFavourite = in_array($course->id, $favouriteCourseIds) ? true : false;
    $isWatchLater = in_array($course->id, $watchLaterCourseIds) ? true : false;
@endphp

<div class="cours">
    <a class="course-img" href="{{ route('courses.show', $course->id) }}"><img src="{{ storageUrl($course->image_path) }}" alt=""></a>
    <div class="caption">
        <div class="meta">
            <a href="{{ route('courses.show', $course->id) }}">{{ $course->{localeAppColumn('name')} }}</a>
            <div class="date">{{ $course->published_at ? $course->published_at->format('d.m.Y') : '' }}</div>
        </div>
        <p>{{ strip_tags($course->{localeAppColumn('description')}) }}</p>
        <div class="course-but">
            <a href="{{ route('courses.show', $course->id) }}" class="more">{{ __('main.read_more') }}
                <img src="{{ asset('front/images/down.svg') }}" alt="">
            </a>
            <a href="" class="button-grey course-watch-later" data-course-id="{{ $course->id }}" style="{{ $isWatchLater ? 'color: #970C13 !important; opacity: 1.0 !important;' : '' }}">
                <img src="{{ asset('front/images/clock.svg') }}" alt="">
                <span>{{ __('main.watch_later') }}</span>
            </a>
            <a href="" class="button-grey course-favourite" data-course-id="{{ $course->id }}" style="{{ $isFavourite ? 'color: #970C13; opacity: 1.0 !important;' : '' }}">
                <img src="{{ asset('front/images/bookmark.svg') }}" alt="">
                <span>{{ __('main.add_to_favourites') }}</span>
            </a>
        </div>
    </div>
</div>
