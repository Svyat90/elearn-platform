<div class="account-nav white col-xs-3">
    <ul>
        <li class="{{ strpos(request()->path(), 'profile/my-account') !== false ? 'active' : '' }}">
            <a href="{{ route('profile.my_account') }}"><img src="{{ asset('front/images/user.svg') }}" alt="">{{ __('profile.personal_data') }}</a>
        </li>
        <li class="{{ strpos(request()->path(), 'favourites') !== false ? 'active' : '' }}">
            <a href="{{ route('profile.favourites') }}"><img src="{{ asset('front/images/bookmark.svg') }}" alt="">{{ __('profile.favourites') }}</a>
        </li>
        <li class="{{ strpos(request()->path(), 'watch-later') !== false ? 'active' : '' }}">
            <a href="{{ route('profile.watch_later') }}"><img src="{{ asset('front/images/clock.svg') }}" alt="">{{ __('profile.watch_later') }}</a>
        </li>
        <li class="{{ strpos(request()->path(), 'profile/my-courses') !== false ? 'active' : '' }}">
            <a href="{{ route('profile.my_courses') }}"><img src="{{ asset('front/images/book.svg') }}" alt="">{{ __('profile.my_courses') }}</a>
        </li>
        <li class="{{ strpos(request()->path(), 'profile/my-documents') !== false ? 'active' : '' }}">
            <a href="{{ route('profile.my_documents') }}"><img src="{{ asset('front/images/doc.svg') }}" alt="">{{ __('profile.my_documents') }}</a>
        </li>
    </ul>
</div>
