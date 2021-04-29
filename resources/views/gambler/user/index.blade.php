@extends('gambler.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card">
            {{-- <div class="mdl-card__title">
                <h1 class="mdl-card__title-text" style="display: flex; align-items: center; justify-content: center">
                    <span class="material-icons">
                        account_circle
                    </span>
                    &nbsp; <strong> {{ $user->name }} </strong>
                </h1>
            </div> --}}

            <div class="mdl-card__supporting-text">

                <div style="
                        background: rgba(0, 0 , 0, 0.05);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        margin: 25px auto 0;
                        padding: 15px;
                        width: 250px;
                        height: 250px;
                    ">
                        <img
                            src="{{ asset('storage/avatar/' . $user->avatar ) }}"
                            alt="avatar"
                            style="height: 250px; width: 200px; "
                        />
                </div>

                <div style="
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto;
                        padding: 15px;
                        width: 250px;
                        flex-direction: column
                    "
                >
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                        style="height: 40px;"
                        href="{{ route('user.avatar') }}"
                    >
                        <span class="mdc-button__label">Alterar avatar</span>
                    </a>

                    <strong style="text-align: center;">{{ $user->name }}</strong>
                    <strong style="text-align: center; margin-top: 10px">{{ $user->email }}</strong>
                </div>

            </div>
        </div>

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
