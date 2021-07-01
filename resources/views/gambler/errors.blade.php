@extends('gambler.layout', ['title' => $error_title ?? 'Erro!' ])

@section('content')
    <style>
        .demo-card-wide.mdl-card {
            dth: 512px;
        }
        .demo-card-wide > .mdl-card__title {
            height: 450px;
            background: url('https://cdn.dribbble.com/users/251873/screenshots/9288094/media/a1c2f89065f68e1b2b5dcb66bdb9beb1.gif') center / cover;
        }
        .demo-card-wide > .mdl-card__menu {
            color: #fff;
        }
    </style>

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell--12-col ">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ $error_title ?? 'Erro' }} </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    {{ $error ?? '' }}
                </div>
            </div>
        </div>
    </div>
@endsection
