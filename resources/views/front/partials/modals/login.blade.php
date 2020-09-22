<div id="login" class="modalDialog">
    <div>
        <a href="#close" title="Закрыть" class="close"> </a>
        <div class="title-section">Login</div>
        <form action="{{ route('login') }}" method="post" name="login">
            <span class="full-input">
                <label for="">E-mail</label>
                <input name="email" type="email" />
            </span>

            <span class="full-input">
                <label for="">Password</label>
                <input name="password" type="password" />
            </span>

            <div id="login-errors" class="full-input no-search" style="display: none;"></div>

            <span class="row-input">
                <label for="">
                    <input class="check" type="checkbox" />
                    Remember me
                </label>
            </span>

            <span class="row-input right">
                <a href="">Forgot password?</a>
            </span>

            <span class="full-input">
                <input class="button" type="submit" value="Login">
            </span>
            <p>
                N-a veti account? <a href="#reg">Registrare</a>
            </p>
        </form>
    </div>
</div>
