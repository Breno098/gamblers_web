@extends('adm.layout', ['title' => 'Inicio'])

@section('content')
    <div class="mdl-grid">
{{--
        <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
            <div
                class="mdl-card__title"
                style="height: 300px; background: url('{{ asset('storage/app/ranking.png') }}') center / cover;"
            >
                <h1
                    class="mdl-card__title-text"
                    style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px;">
                    <strong>Ranking</strong>
                </h1>
            </div>
            <div class="mdl-card__supporting-text" style="width: 97%">
                <ul class="mdl-list">
                    @foreach ($scoreboards as $score)
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <i class="material-icons">star</i>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; {{ $score->score }} | {{ $score->user->name }}
                            </span>
                        </li>
                        <hr/>
                    @endforeach
                </ul>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Ver ranking total
                </a>
            </div>
            <div class="mdl-card__menu">
                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons">share</i>
                </button>
            </div>
        </div> --}}

        <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
            <div
                class="mdl-card__title"
                style="height: 300px; background: url('{{ asset('storage/app/score-rules.jpg') }}') center / cover;"
            >
                <h1
                    class="mdl-card__title-text"
                    style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px;">
                    <strong>Regras</strong>
                </h1>
            </div>
            <div class="mdl-card__supporting-text" style="width: 97%">
                <ul class="mdl-list">
                    @foreach ($rules as $rule)
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <i class="material-icons">star</i>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; {{ $rule['score'] }} | {{ $rule['description'] }}
                            </span>
                        </li>
                        <hr/>
                    @endforeach
                </ul>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Ver regulamento
                </a>
            </div>
            <div class="mdl-card__menu">
                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons">share</i>
                </button>
            </div>
        </div>
    </div>
@endsection
