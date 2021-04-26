<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-light_green.min.css" /> <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-green.min.css" />

        <link rel="stylesheet" href="{{ asset('/getmdl/getmdl-select.min.css') }} ">
        <script defer src="{{ asset('getmdl/getmdl-select.min.js') }}"></script>

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
            }

        </style>
    </head>
    <body>
        <div class="demo-layout-waterfall mdl-layout mdl-js-layout ">
            <header class="mdl-layout__header mdl-layout__header--waterfall">
                <div class="mdl-layout__header-row mdl-color--orange-900">
                    <span class="mdl-layout-title">Gamblers</span>

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
                <span class="mdl-layout-title">Gamblers</span>
                <nav class="mdl-navigation">

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.dashboard') }}">
                        <i class="mdl-color-text--black material-icons" role="presentation">home</i>
                        DashBoard
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.country.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">public</i>
                        Países
                    </a>

                    <a class="mdl-navigation__link mdl-color-text--black" href="{{ route('adm.team.index') }}" >
                        <i class="mdl-color-text--black material-icons" role="presentation">groups</i>
                        Times
                    </a>

                </nav>
            </div>

            <main class="mdl-layout__content" >
                <div class="page-content" style="padding-top: 30px">
                    @yield('content')
                </div>
            </main>
        </div>
        <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    </body>
</html>
