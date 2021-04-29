@extends('adm.layout')

@section('content')
    <div class="mdl-grid">
        @foreach ($scores as $score)
            <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card mdl-shadow--16dp">
                <div class="mdl-card__title">
                    <h1 class="mdl-card__title-text" style="display: flex; align-items: center">
                        <span class="material-icons">
                            account_circle
                        </span>
                        &nbsp; <strong> {{ $user->name }} </strong>
                    </h1>
                </div>

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
                        href="{{ route('adm.user.report', [ 'user' => $user, 'competition' => $score->competition_id ]) }}"
                        style="width: 100%; height: 40px; min-width: initial;"
                    >
                        <i class="material-icons">info</i>
                        <span class="mdc-button__label">Ver mais infomações</span>
                    </a>
                </div>
            </div>
        @endforeach

        <div class="mdl-card__actions" style="width: 100%; justify-content: flex-end; display: flex">
            <div>
            <a
                class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $scores->previousPageUrl() ? 'mdl-button--primary' : '' }}"
                {{ $scores->previousPageUrl() ?? 'disabled' }}
                href="{{ $scores->previousPageUrl() ?: '#' }}"
            >
                <span class="material-icons"> arrow_back_ios </span>
            </a>
            <a
                class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $scores->nextPageUrl() ? 'mdl-button--primary' : '' }}"
                {{ $scores->nextPageUrl() ?? 'disabled' }}
                href="{{ $scores->nextPageUrl() ?: '#' }}"
            >
                <span class="material-icons"> arrow_forward_ios </span>
            </a>
            </div>
        </div>
    </div>
@endsection
