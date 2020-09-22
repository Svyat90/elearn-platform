<div id="reg" class="modalDialog">
    <div>
        <a href="#close" title="Закрыть" class="close"> </a>
        <div class="title-section">Registrare</div>
        <form action="{{ route('register') }}" method="post" name="register">
            <span class="full-input">
                <label for="">E-mail</label>
                <input name="email-register" type="email" />
            </span>

            <span class="full-input password-input">
                <label for="">Password</label>
                <span class="show"></span>
                <input class="password" name="password-register" type="password">
            </span>

            <span class="full-input password-input">
                <label for="">Confirm password</label>
                <span class="show"></span>
                <input class="password" name="confirm-password-register" type="password">
            </span>

            <div id="register-errors" class="full-input no-search" style="display: none;"></div>

            <span class="full-input">
                <input class="button" type="submit" value="Login">
            </span>

            <p>
                Aveti account? <a href="#login">Login</a>
            </p>

        </form>
    </div>
</div>
