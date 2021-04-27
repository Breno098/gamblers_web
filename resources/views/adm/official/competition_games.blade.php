@extends('adm.layout')

@section('content')
    <div class="mdl-grid" style="display: flex; justify-content: center">

        @foreach ($games as $game)
            <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--16dp" style="text-decoration: none">
                <div class="mdl-card__title" style="display: flex; flex-direction: row; justify-content: space-between">
                    <h1 class="mdl-card__title-text" style="display: flex; align-items: center">
                        <i class="mdl-color-text--black material-icons" role="presentation">emoji_events</i>
                        <strong>  &nbsp; {{ $game->competition->name }} </strong>
                    </h1>
                    <h1 class="mdl-card__title-text">
                        <strong> {{ Str::ucfirst($game->stage) }} </strong>
                    </h1>
                </div>

                <div class="mdl-card__title" style="display: flex; flex-direction: row; justify-content: space-between">
                    <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--4dp">
                        <div class="mdl-card__title" style="height: 450px; background: url('{{ asset('storage/teams/' . $game->teamHome->name_photo) }}') center / cover;">
                            <h1 class="mdl-card__title-text" style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px;">
                                <strong> {{ $game->teamHome->name }} </strong>
                            </h1>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--4dp">
                        <div class="mdl-card__title" style="height: 450px; background: url('{{ asset('storage/teams/' . $game->teamGuest->name_photo) }}') center / cover;">
                            <h1 class="mdl-card__title-text" style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px;">
                                <strong> {{ $game->teamGuest->name }} </strong>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="mdl-card__title" style="display: flex; flex-direction: row; justify-content: space-between">
                    <div class="mdl-cell mdl-cell--12-col mdl-card">
                        <div class="mdl-card__title" style="display: flex; justify-content: center">
                            <h1 class="mdl-card__title-text">
                                <strong> {{ $game->date->format('d/m/Y') }} | {{ $game->time->format("H:i") }} </strong>
                            </h1>
                        </div>
                        <hr style="width: 90%; margin: 0 auto" class="mdl-color--accent"/>
                        <div class="mdl-card__title" style="display: flex; justify-content: center">
                            <h1 class="mdl-card__title-text">
                                <strong> {{ $game->stadium->name }} </strong>
                            </h1>
                        </div>
                        <hr style="width: 90%; margin: 0 auto" class="mdl-color--accent"/>
                        <div class="mdl-card__title" >
                            <a
                                href="{{ route('adm.official.game', ['game' => $game]) }}"
                                style="width: 100%; height: 40px; min-width: initial;"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white"
                            >
                                <strong> Adicionar resultado </strong>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
