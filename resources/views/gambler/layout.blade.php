<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('mdl/material.deep_orange-green.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

        <title>Gamblers {{ isset($title) ? "| {$title}" : '' }}</title>

        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Gamblers">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=RocknRoll+One&display=swap');
            * { font-family: 'RocknRoll One', sans-serif; }
        </style>
    </head>
    <body>
        <script src="{{ asset('mdl/material.min.js') }}"></script>

        <div class="demo-layout-waterfall mdl-layout mdl-js-layout ">
            <header class="mdl-layout__header mdl-layout__header--waterfall">
                <div class="mdl-layout__header-row mdl-color--primary">
                    <span class="mdl-layout-title">Gamblers</span>

                    <div class="mdl-layout-spacer"></div>
                </div>
            </header>

            <div class="mdl-layout__drawer">

                <strong style="text-align: center; margin-top: 10px">{{ Auth::user()->name }}</strong>

                <div style="
                    background: rgba(0, 0 , 0, 0.05);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    margin: 5px;
                    padding: 15px
                ">
                    <img
                        src="{{ asset('storage/avatar/' . Auth::user()->avatar ) }}"
                        alt="avatar"
                        style="height: 200px; width: 150px;"
                    />
                </div>

                <nav class="mdl-navigation">

                    @if (Auth::user()->type === 'adm')
                        <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                        <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.dashboard') }}">
                            <i class="mdl-color-text--black material-icons" role="presentation">work</i>
                            Administrativo
                        </a>
                    @endif

                    <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('dashboard') }}">
                        <i class="mdl-color-text--black material-icons" role="presentation">home</i>
                        Início
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('official.competitions') }}">
                        <i class="mdl-color-text--black material-icons" role="presentation">sports_soccer</i>
                        Jogos
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('ranking.index') }}">
                        <i class="mdl-color-text--black material-icons" role="presentation">leaderboard</i>
                        Ranking
                    </a>

                    <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('user.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">group</i>
                        Perfil
                    </a>

                    <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('logout') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">logout</i>
                        Sair
                    </a>

                </nav>
            </div>

            <main class="mdl-layout__content" >
                <div class="page-content" style="padding: 30px 0 50px 0">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
