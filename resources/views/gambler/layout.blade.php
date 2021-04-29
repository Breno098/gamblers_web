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

            .avatar:hover {
                background-color: rgba(0, 0, 0, 0.08)
            }
        </style>
    </head>
    <body>
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
                        DashBoard
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

        <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    </body>
</html>
