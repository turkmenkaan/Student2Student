
<!-- Bulma Pre-Made Navbar Start -->
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand" style="left-margin:5%">
        <a class="navbar-item" href="{{ route('home') }}">
            <img src="{{ asset('storage/images/full-logo.png') }}" id="logo">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item mainMenu" href="{{ route('home') }}">
                Ana Sayfa
            </a>

            <a class="navbar-item mainMenu" href="{{ route('lessons') }}">
                Dersler
            </a>

            <a class="navbar-item mainMenu" href="{{ route('teachers') }}">
                Ders Verenler
            </a>

            @if (auth()->user()->isTeacher)
                <a class="navbar-item mainMenu" href="{{ route('dashboard') }}">
                    Programım
                </a>
            @endif

        </div>

        <div class="navbar-end" style="right-margin: 5%">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" id="rightMenu">
                    {{ Auth::user()->name }}
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                        Profil
                    </a>
                    <a class="navbar-item" href="{{ route('contact') }}">
                        Bize Ulaşın
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Çıkış Yap
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Bulma Pre-Made Navbar End -->