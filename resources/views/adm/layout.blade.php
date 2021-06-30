<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('mdl/material.deep_orange-green.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

        <title>Gamblers</title>

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
                    <span class="mdl-layout-title">Gamblers Adm</span>

                    <div class="mdl-layout-spacer"></div>
                </div>
            </header>

            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Gamblers Adm</span>
                <nav class="mdl-navigation">

                    <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.dashboard') }}">
                        <i class="mdl-color-text--black material-icons" role="presentation">home</i>
                        DashBoard
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.official.competitions') }}">
                        <i class="mdl-color-text--black material-icons" role="presentation">sports_soccer</i>
                        Jogos Oficiais
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.ranking.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">leaderboard</i>
                        Ranking
                    </a>

                    <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.game.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">sports</i>
                        Jogo
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.team.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">groups</i>
                        Time
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.country_team.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">public</i>
                        Seleção
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.team.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">groups</i>
                        Time
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.player.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">person</i>
                        Jogador
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.stadium.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">home</i>
                        Estádio
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.competition.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">emoji_events</i>
                        Competição
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.country.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">public</i>
                        País
                    </a>

                    <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.user.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">group</i>
                        Usuários
                    </a>

                    <hr style="width: 90%; margin: auto" class="mdl-color--primary"/>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('dashboard') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">casino</i>
                        Apostar
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
