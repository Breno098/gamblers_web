@extends('adm.layout', ['title' => 'Estádios'])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong> Estádios </strong>
                </h1>
            </div>

            <div style="width: 100%; display: flex; justify-content: center">
                <div class="mdl-card__supporting-text table-responsive">
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" aria-label="Países" style="width: 100%">
                        <thead>
                            <tr class="mdc-data-table__header-row">
                                <th class="mdl-data-table__cell--non-numeric">Nome</th>
                                <th class="mdl-data-table__cell--non-numeric">País</th>
                                <th class="mdl-data-table__cell--non-numeric"></th>
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content">
                            @foreach ($stadia as $stadium)
                            <tr class="mdc-data-table__row">
                                <td class="mdl-data-table__cell--non-numeric" style="width: 45%">{{ $stadium->name }}</td>
                                <td class="mdl-data-table__cell--non-numeric" style="width: 45%">{{ $stadium->country->name }}</td>
                                <td class="mdl-data-table__cell--non-numeric" style="width: 10%">
                                    <a
                                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                                        href="{{ route('adm.stadium.edit', [ 'stadium' => $stadium ]) }}"
                                    >
                                        <i class="material-icons">edit</i>
                                        <span class="mdc-button__label">Editar</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mdl-card__actions" style="width: 100%; justify-content: flex-end; display: flex">
                        <div>
                        <a
                            class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $stadia->previousPageUrl() ? 'mdl-button--primary' : '' }}"
                            {{ $stadia->previousPageUrl() ?? 'disabled' }}
                            href="{{ $stadia->previousPageUrl() ?: '#' }}"
                        >
                            <span class="material-icons"> arrow_back_ios </span>
                        </a>
                        <a
                            class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $stadia->nextPageUrl() ? 'mdl-button--primary' : '' }}"
                            {{ $stadia->nextPageUrl() ?? 'disabled' }}
                            href="{{ $stadia->nextPageUrl() ?: '#' }}"
                        >
                            <span class="material-icons"> arrow_forward_ios </span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>

            <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                href="{{ route('adm.stadium.create')}}"
                style="position: fixed; display: block; left: 0; bottom: 0; margin-left: 40px; margin-bottom: 40px;z-index: 900;">

                <i class="material-icons">add</i>
            </a>
        </div>
    </div>

@endsection
