<div class="account-nav white col-xs-3">
    <ul>
        <li class="{{ request()->is('profile/personal_data') ? 'active' : '' }}">
            <a href=""><img src="{{ asset('front/images/user.svg') }}" alt="">{{ __('profile.personal_data') }}</a>
        </li>
        <li class="{{ request()->is('profile/favourites') ? 'active' : '' }}">
            <a href=""><img src="{{ asset('front/images/bookmark.svg') }}" alt="">{{ __('profile.favourites') }}</a>
        </li>
        <li class="{{ request()->is('profile/watch_later') ? 'active' : '' }}">
            <a href=""><img src="{{ asset('front/images/clock.svg') }}" alt="">{{ __('profile.watch_later') }}</a>
        </li>
        <li class="{{ request()->is('profile/my_courses') ? 'active' : '' }}">
            <a href="{{ route('profile.my_courses') }}"><img src="{{ asset('front/images/book.svg') }}" alt="">{{ __('profile.my_courses') }}</a>
        </li>
        <li class="{{ request()->is('profile/my_documents') ? 'active' : '' }}">
            <a href="{{ route('profile.my_documents') }}"><img src="{{ asset('front/images/doc.svg') }}" alt="">{{ __('profile.my_documents') }}</a>
        </li>
    </ul>
</div>
