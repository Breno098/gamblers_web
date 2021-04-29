@extends('gambler.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>{{ $competition->name }}</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text" style="height: 200px; display:flex; flex-direction: row; align-items: flex-end">

                <div class="mdl-cell mdl-cell--4-col" style="display: flex; flex-direction: column; align-items: center">
                    <strong>{{ isset($scores[2]) ? $scores[2]->user_name : '--'  }}</strong>
                    <div class="mdl-cell mdl-cell--12-col  mdl-color--primary" style="height: 50px">
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col" style="display: flex; flex-direction: column; align-items: center">
                    <strong>{{ isset($scores[0]) ? $scores[0]->user_name : '--'  }}</strong>
                    <div class="mdl-cell mdl-cell--12-col  mdl-color--primary" style="height: 150px">
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col" style="display: flex; flex-direction: column; align-items: center">
                    <strong>{{ isset($scores[1]) ? $scores[1]->user_name : '--'  }}</strong>
                    <div class="mdl-cell mdl-cell--12-col  mdl-color--primary" style="height: 100px">
                    </div>
                </div>

            </div>

            <div class="mdl-card__supporting-text">
                <div style="width: 100%; display: flex; justify-content: center">
                    <div class="mdl-card__supporting-text table-responsive">
                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" aria-label="Países" style="width: 100%">
                            <thead>
                                <tr class="mdc-data-table__header-row">
                                    <th class="mdl-data-table__cell--non-numeric">Usuário</th>
                                    <th class="mdl-data-table__cell--non-numeric">Pontuação</th>
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content">
                                @foreach ($scores as $score)
                                <tr class="mdc-data-table__row">
                                    <td class="mdl-data-table__cell--non-numeric" style="width: 40%">{{ $score->user_name }}</td>
                                    <td class="mdl-data-table__cell--non-numeric" style="width: 40%">{{ $score->total_score }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                </div>
            </div>
        </div>
    </div>
@endsection
