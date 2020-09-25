<div class="cours">
    <a class="course-img" href="{{ route('courses.show', $course->id) }}"><img src="{{ storageUrl($course->image_path) }}" alt=""></a>
    <div class="caption">
        <div class="meta">
            <a href="{{ route('courses.show', $course->id) }}">{{ $course->{localeAppColumn('name')} }}</a>
            <div class="date">{{ $course->published_at }}</div>
        </div>
        <p>{{ strip_tags($course->{localeAppColumn('description')}) }}</p>
        <div class="course-but">
            <a href="{{ route('courses.show', $course->id) }}" class="more">{{ __('main.read_more') }}
                <img src="{{ asset('front/images/down.svg') }}" alt="">
            </a>
            <a href="" class="button-grey"><img src="{{ asset('front/images/clock.svg') }}" alt="">
                <span>{{ __('main.watch_later') }}</span>
            </a>
            <a href="" class="button-grey">
                <img src="{{ asset('front/images/bookmark.svg') }}" alt="">
                <span>{{ __('main.add_to_favourites') }}</span>
            </a>
        </div>
    </div>
</div>
