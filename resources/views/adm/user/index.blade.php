@extends('adm.layout')

@section('content')
    <div class="mdl-grid">
        @foreach ($users as $user)
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
                                    email
                                </span>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ $user->email }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <span class="material-icons">
                                    add_circle
                                </span>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ $user->created_at->format('d/m/Y') }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                    </ul>
                </div>
                <div class="mdl-card__actions ">
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                        href="{{ route('adm.user.info', [ 'user' => $user ]) }}"
                        style="width: 100%; height: 40px; min-width: initial;"
                    >
                        <i class="material-icons">info</i>
                        <span class="mdc-button__label">Ver mais infomações</span>
                    </a>
                </div>
            </div>
        @endforeach

        <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card">
                <div class="mdl-card__actions" style="width: 100%; justify-content: flex-end; display: flex">
                    <div>
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $users->previousPageUrl() ? 'mdl-button--primary' : '' }}"
                        {{ $users->previousPageUrl() ?? 'disabled' }}
                        href="{{ $users->previousPageUrl() ?: '#' }}"
                    >
                        <span class="material-icons"> arrow_back_ios </span>
                    </a>
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $users->nextPageUrl() ? 'mdl-button--primary' : '' }}"
                        {{ $users->nextPageUrl() ?? 'disabled' }}
                        href="{{ $users->nextPageUrl() ?: '#' }}"
                    >
                        <span class="material-icons"> arrow_forward_ios </span>
                    </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
            href="{{ route('adm.user.create')}}"
            style="position: fixed; display: block; left: 0; bottom: 0; margin-left: 40px; margin-bottom: 40px;z-index: 900;">

            <i class="material-icons">add</i>
        </a> --}}
    </div>
@endsection
