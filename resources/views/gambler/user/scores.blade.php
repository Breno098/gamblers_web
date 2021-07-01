@extends('gambler.layout', ['title' => 'Minhas Pontuações'])

@section('content')
    <div class="mdl-grid">
        @foreach ($scores as $score)
            <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card mdl-shadow--16dp">
                <div class="mdl-card__supporting-text">
                    <ul class="mdl-list">
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <span class="material-icons">
                                    emoji_events
                                </span>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ $score->competition_name }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <strong> Temporada: </strong>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ $score->competition_season }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <strong> Pontuação total: </strong>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ number_format($score->total_score, 2, '.', '') }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                    </ul>
                </div>
                <div class="mdl-card__actions ">
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                        href="{{ route('user.report', [ 'competition' => $score->competition_id ]) }}"
                        style="width: 100%; height: 40px; min-width: initial;"
                    >
                        <i class="material-icons">info</i>
                        <span class="mdc-button__label">Ver mais infomações</span>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
@endsection
