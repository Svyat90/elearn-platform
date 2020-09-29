@extends('layouts.front')
@section('content')
    <main>

        <section class="container account">
            <div class="title-section">{{ __('profile.my_account') }}</div>
            <div class="row">

                @include('front.partials.navigationProfile')

                <div class="account-content white col-xs-9">
                    <div class="grid">
                        <div class="title">{{ __('profile.main_information') }}</div>

                        <form class="user-detail" action="{{ route('profile.update_data') }}" method="post">
                            @csrf
                            <span class="row-input">
                                <label for="first_name">{{ __('profile.first_name') }}</label>
                                <input name="first_name" id="first_name" type="text" value="{{ old('first_name', $user->first_name) }}">
                            </span>

                            <span class="row-input">
                                <label for="last_name">{{ __('profile.last_name') }}</label>
                                <input name="last_name" id="last_name" type="text" value="{{ old('last_name', $user->last_name) }}">
                            </span>

                            <span class="row-input">
                                <label for="email">{{ __('profile.email') }}</label>
                                <input name="email" id="email" type="email" value="{{ old('email', $user->email) }}">
                            </span>

                            <span class="row-input">
                                <label for="phone">{{ __('profile.phone') }}</label>
                                <input name="phone" id="phone" type="tel" value="{{ old('phone', $user->phone) }}">
                            </span>

                            <span class="row-input">
                                <label for="institution">{{ __('profile.institution') }}</label>
                                <select name="institution" id="institution">
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution }}" {{ old('institution', $user->institution) === $institution ? 'selected' : '' }}>{{ $institution }}</option>
                                    @endforeach
                                </select>
                            </span>

                            <span class="row-input">
                                <label for="position">{{ __('profile.position') }}</label>
                                <input name="position" id="position" type="text" value="{{ old('position', $user->position) }}">
                            </span>

                            @if(Session::has('updateUserData'))
                                <span class="row-input" style="{{ $errors->any() ? '' : 'display: none;' }} background: #F8E4E5; padding: 25px 40px; color: #970C13; width: 100%; text-align: center; margin-right: 30px;">
                                @if($errors->any())
                                        {!! implode('', $errors->all('<strong>:message</strong><br>')) !!}
                                @endif
                                </span>
                            @endif

                            <span class="full-input right">
                                <input type="submit" class="button" value="{{ __('profile.save_changes') }}">
                            </span>
                        </form>

                        <div class="title">{{ __('profile.password') }}</div>

                        <form class="user-password" action="{{ route('profile.update_password') }}" method="post">
                            @csrf
                            <span class="row-input password-input">
                                <label for="old_password">{{ __('profile.old_password') }}</label>
                                <span class="show"></span>
                                <input name="old_password" id="old_password" class="password" type="password" value="{{ old('old_password') }}">
                            </span>

                            <span class="row-input password-input">
                                <label for="new_password">{{ __('profile.new_password') }}</label>
                                <span class="show"></span>
                                <input name="new_password" id="new_password" class="password" type="password" {{ old('new_password') }}>
                            </span>

                            @if(Session::has('updatePassword'))
                                <span class="row-input" style="{{ $errors->any() ? '' : 'display: none;' }} background: #F8E4E5; padding: 25px 40px; color: #970C13; width: 100%; text-align: center; margin-right: 30px;">
                                @if($errors->any())
                                        {!! implode('', $errors->all('<strong>:message</strong><br>')) !!}
                                    @endif
                                </span>
                            @endif

                            <span class="full-input right">
                                <input type="submit" class="button" value="{{ __('profile.save_changes') }}">
                            </span>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('scripts')
    @parent
@endsection
