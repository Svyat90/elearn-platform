<div id="reg" class="modalDialog">
    <div>
        <a href="#close" title="{{ __('main.close') }}" class="close"> </a>
        <div class="title-section">{{ __('auth.register') }}</div>
        <form action="{{ route('register') . '/ru' }}" method="post" name="register">
            <span class="full-input">
                <label for="">{{ __('auth.email') }}</label>
                <input name="email-register" type="email" />
            </span>

            <span class="full-input password-input">
                <label for="">{{ __('auth.password') }}</label>
                <span class="show"></span>
                <input class="password" name="password-register" type="password">
            </span>

            <span class="full-input password-input">
                <label for="">{{ __('auth.confirm_password') }}</label>
                <span class="show"></span>
                <input class="password" name="confirm-password-register" type="password">
            </span>

            <div id="register-errors" class="full-input no-search" style="@if(Session::has('adminHaveToConfirm'))  @else display: none @endif">
                @if(session('adminHaveToConfirm'))
                    <strong>{{ __('global.admin_have_to_confirm') }}</strong>
                @endif
            </div>

            <span class="full-input">
                <input class="button" type="submit" value="{{ __('auth.register') }}">
            </span>

            <p>
                {{ __('auth.do_you_have_account') }} <a href="#login">{{ __('auth.login') }}</a>
            </p>

        </form>
    </div>
</div>
