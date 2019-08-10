
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ route('home') }}">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
                <a class="button is-primary" href="{{ route('register') }}">
                    <strong>Kayıt Ol</strong>
                </a>
                <a class="button is-light" href="{{ route('login') }}">
                    Giriş Yap
                </a>
            </div>
        </div>
    </div>
    </div>
</nav>