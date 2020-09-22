<header>
    <div class="head-top container-fluid">
        <div class="contact">
            <span>Phone: <a href="tel:+373859495">+373 85 94 95</a></span>
            <span>E-mail: <a href="mailto:e-learning@gmail.com">e-learning@gmail.com</a></span>
            <span>Adress: <a href="https://maps.google.com?saddr=Current+Location&daddr=47.025007,28.818153">MD 2004, Republica Moldova, Chișinău, str. S.Lazo, 1</a></span>
        </div>
        <ul class="lang">
            <li class="{{ app()->getLocale() === 'ro' ? 'active' : '' }}"><a href="{{ route('setLocate', 'ro') }}">RO</a></li>
            <li class="{{ app()->getLocale() === 'en' ? 'active' : '' }}"><a href="{{ route('setLocate', 'en') }}">EN</a></li>
            <li class="{{ app()->getLocale() === 'ru' ? 'active' : '' }}"><a href="{{ route('setLocate', 'ru') }}">RU</a></li>
        </ul>
    </div>
    <div class="head-bottom container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="head-left">
                    <div class="top-catalog">
                        <div class="toggle"><span></span><span></span><span></span></div>
                        <span class="links">Categorii</span>
                    </div>
                    <div class="logo"><a href="/"><img src="{{ asset('front/images/logo.svg') }}" alt=""></a></div>

                    <form class="search" action="">
                        <input type="search" placeholder="Cauta documente...">
                        <button type="submit"></button>
                    </form>

                    <ul class="lang md-hidden">
                        <li><a href="">RO</a></li>
                        <li class="active"><a href="">EN</a></li>
                    </ul>

                </div>
            </div>
            <div class="col-md-6">
                <div class="head-right">
                    <a class="md-hidden" href=""><img src="{{ asset('front/images/search.svg') }}" alt=""></a>
                    <a href=""><span>Watch later</span><img src="{{ asset('front/images/clock.svg') }}" alt=""></a>
                    <a href=""><span>Favourites</span><img src="{{ asset('front/images/bookmark.svg') }}" alt=""></a>
                    @if( ! Auth::user())
                        @include('front.partials.modals.login')
                        @include('front.partials.modals.registration')
                        <a class="login" href="#login">{{ trans('auth.login') }}</a>
                        <a href="#reg" class="button">Registrare</a>
                    @else
                        <span class="login" href="#login">{{ auth()->user()->email }}</span>
                        <a class="login" id="logout-btn" href="#" >Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="nav-box">
            <nav class="menu">
                <ul class="navigation">
                    <li><a href="">Actele normative:</a>
                        <ul class="submenu">
                            <li><a href="">Emise de către Consiliul Institutului Național al Justiției;</a></li>
                            <li><a href="">Emise de către Directorul Institutului Național al Justiției;</a></li>
                            <li><a href="">Altele legate de activitatea Institutului Național al Justiției.</a></li>
                        </ul>
                    </li>
                    <li><a href="">Actele legate de evaluările (continue/finale):</a></li>
                    <li><a href="">Calendarul</a>
                        <ul class="submenu">
                            <li><a href="">Tematica</a></li>
                            <li><a href="">Subiectele</a></li>
                            <li><a href="">și altele.</a></li>
                        </ul>
                    </li>
                    <li><a href="">Materialele de cercetare</a>
                        <ul class="submenu">
                            <li><a href="">Cărți</a></li>
                            <li><a href="">Monografii</a></li>
                            <li><a href="">Studii</a></li>
                            <li><a href="">Articole științifice</a></li>
                            <li><a href="">Alte materiale elaborate în procesul de cercetare</a></li>
                        </ul>
                    </li>
                    <li><a href="">Materialele metodico-didactice elaborate în cadrul instruirilor inițiale și
                            continue:</a>
                        <ul class="submenu">
                            <li><a href="">Suporturi de curs</a></li>
                            <li><a href="">Module</a></li>
                            <li><a href="">Recomandări didactice</a></li>
                            <li><a href="">Materiale didactice</a></li>
                            <li><a href="">Ghiduri</a></li>
                            <li><a href="">Altele legate de activitatea Institutului Național al Justiției.</a></li>
                            <li><a href="">Instrucțiuni metodice</a></li>
                            <li><a href="">Texte de cursuri</a></li>
                            <li><a href="">Texte de cursuri</a></li>
                            <li><a href="">Compendii</a></li>
                            <li><a href="">Studii</a></li>
                            <li><a href="">Rapoarte</a></li>
                            <li><a href="">Prezentări</a></li>
                            <li><a href="">Planuri de curs și seminare etc</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>


    </div>
    <div class="head-nav container-fluid">
        <div class="toggle"><span></span><span></span><span></span></div>
        <ul>
            <li><a href="">Despre noi</a></li>
            <li><a href="">Cursuri electronice</a></li>
            <li><a href="">Materiale informative</a></li>
            <li><a href="">Contacte</a></li>
        </ul>
    </div>
</header>
