@extends('adm.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>{{ $user->name }} ({{ $user->email }}) </strong>
                </h1>
            </div>

            <div style="width: 100%; display: flex; justify-content: center;">
                <div class="mdl-card__supporting-text table-responsive">
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" aria-label="Países" style="width: 100%;">
                        <thead>
                            <tr class="mdc-data-table__header-row">
                                <th class="mdl-data-table__cell--non-numeric">Competição</th>
                                <th class="mdl-data-table__cell--non-numeric">Temporada</th>
                                <th class="mdl-data-table__cell--non-numeric">Potuação Total</th>
                                <th class="mdl-data-table__cell--non-numeric"></th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content">
                            @foreach ($scores as $score)
                            <tr class="mdc-data-table__row">
                                <td class="mdl-data-table__cell--non-numeric" style="width: 30%">{{ $score->competition_name }}</td>
                                <td class="mdl-data-table__cell--non-numeric" style="width: 30%">{{ $score->competition_season }}</td>
                                <td class="mdl-data-table__cell--non-numeric" style="width: 30%">{{ number_format($score->total_score, 2, '.', '')  }}</td>
                                <td class="mdl-data-table__cell--non-numeric" style="width: 10%">
                                    <a
                                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                                        href="{{ route('adm.user.report', [ 'user' => $user, 'competition' => $score->competition_id ]) }}"
                                    >
                                        <i class="material-icons">info</i>
                                        <span class="mdc-button__label">Infomações</span>
                                    </a>
                                </td>
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
@endsection
