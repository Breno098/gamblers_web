<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-light_green.min.css" /> <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-green.min.css" />

        <title>Gamblers</title>

        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Gamblers">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=RocknRoll+One&display=swap');

            * {
                font-family: 'RocknRoll One', sans-serif;
            }

            .demo-layout-waterfall .mdl-layout__header-row .mdl-navigation__link:last-of-type  {
                padding-right: 0;
            }

            .mdl-button--file input {
                cursor: pointer;
                height: 100%;
                right: 0;
                opacity: 0;
                position: absolute;
                top: 0;
                width: 300px;
                z-index: 4;
            }
            .mdl-textfield--file .mdl-textfield__input {
                box-sizing: border-box;
                width: calc(100% - 32px);
            }
            .mdl-textfield--file .mdl-button--file {
                right: 0;
                background: rgba(0, 0, 0, 0.2)
            }

            .table-responsive {
                min-height: .01%;
                overflow-x: auto;
            }

            @media screen and (max-width: 767px) {
                .table-responsive {
                    width: 100%;
                    margin-bottom: 15px;
                    overflow-y: hidden;
                    -ms-overflow-style: -ms-autohiding-scrollbar;
                    border: 1px solid #ddd;
                }
                .table-responsive > .table {
                    margin-bottom: 0;
                }
                .table-responsive > .table > thead > tr > th,
                .table-responsive > .table > tbody > tr > th,
                .table-responsive > .table > tfoot > tr > th,
                .table-responsive > .table > thead > tr > td,
                .table-responsive > .table > tbody > tr > td,
                .table-responsive > .table > tfoot > tr > td {
                    white-space: nowrap;
                }
                .table-responsive > .table-bordered {
                    border: 0;
                }
                .table-responsive > .table-bordered > thead > tr > th:first-child,
                .table-responsive > .table-bordered > tbody > tr > th:first-child,
                .table-responsive > .table-bordered > tfoot > tr > th:first-child,
                .table-responsive > .table-bordered > thead > tr > td:first-child,
                .table-responsive > .table-bordered > tbody > tr > td:first-child,
                .table-responsive > .table-bordered > tfoot > tr > td:first-child {
                    border-left: 0;
                }
                .table-responsive > .table-bordered > thead > tr > th:last-child,
                .table-responsive > .table-bordered > tbody > tr > th:last-child,
                .table-responsive > .table-bordered > tfoot > tr > th:last-child,
                .table-responsive > .table-bordered > thead > tr > td:last-child,
                .table-responsive > .table-bordered > tbody > tr > td:last-child,
                .table-responsive > .table-bordered > tfoot > tr > td:last-child {
                    border-right: 0;
                }
                .table-responsive > .table-bordered > tbody > tr:last-child > th,
                .table-responsive > .table-bordered > tfoot > tr:last-child > th,
                .table-responsive > .table-bordered > tbody > tr:last-child > td,
                .table-responsive > .table-bordered > tfoot > tr:last-child > td {
                    border-bottom: 0;
                }
            }

        </style>
    </head>
    <body>
        <div class="demo-layout-waterfall mdl-layout mdl-js-layout ">
            <header class="mdl-layout__header mdl-layout__header--waterfall">
                <div class="mdl-layout__header-row mdl-color--primary">
                    <span class="mdl-layout-title">Gamblers Adm</span>

                    <div class="mdl-layout-spacer"></div>

                    {{-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                                mdl-textfield--floating-label mdl-textfield--align-right">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="waterfall-exp">
                            <i class="material-icons">search</i>
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <input class="mdl-textfield__input" type="text" name="sample" id="waterfall-exp">
                        </div>
                    </div> --}}
                </div>

                {{-- <div class="mdl-layout__header-row">
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation -->
                    <nav class="mdl-navigation">
                        <a class="mdl-navigation__link" href="">Link</a>
                        <a class="mdl-navigation__link" href="">Link</a>
                        <a class="mdl-navigation__link" href="">Link</a>
                        <a class="mdl-navigation__link" href="">Link</a>
                    </nav>
                </div> --}}
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

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.country.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">public</i>
                        País
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

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.game.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">sports</i>
                        Jogo
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

        <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    </body>
</html>
