<div id="login" class="modalDialog">
    <div>
        <a href="#close" title="{{ __('main.close') }}" class="close"> </a>
        <div class="title-section">{{ __('auth.login') }}</div>
        <form action="{{ route('login') }}" method="post" name="login">
            <span class="full-input">
                <label for="">{{ __('auth.email') }}</label>
                <input name="email" type="email" />
            </span>

            <span class="full-input">
                <label for="">{{ __('auth.password') }}</label>
                <input name="password" type="password" />
            </span>

            <div id="login-errors" class="full-input no-search" style="display: none;"></div>

            <span class="row-input">
                <label for="">
                    <input class="check" type="checkbox" />
                    {{ __('auth.remember_me') }}
                </label>
            </span>

            <span class="row-input right">
                <a href="">{{ __('auth.forgot_password') }}</a>
            </span>

            <span class="full-input">
                <input class="button" type="submit" value="{{ __('auth.login') }}">
            </span>
            <p>
                {{ __('auth.dont_have_account') }} <a href="#reg">{{ __('auth.register') }}</a>
            </p>
        </form>
    </div>
</div>
