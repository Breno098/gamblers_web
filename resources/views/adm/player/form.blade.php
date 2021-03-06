@extends('adm.layout', ['title' => isset($player) ? 'Alterar Jogador' : 'Cadastrar Jogador' ])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>{{ isset($player) ? 'Alterar Jogador' : 'Cadastrar Jogador' }}</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                <form
                    action="{{ isset($player) ? route('adm.player.update', ['player' => $player]) : route('adm.player.store') }}"
                    method="POST"
                >

                    @method( isset($player) ? 'PUT' : 'POST')
                    <div style="display: flex; flex-direction: column">
                        @csrf
                        <input name="id" id="id" hidden value="{{ $player->id ?? '' }}"/>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input class="mdl-textfield__input" name="name" id="name" value="{{ $player->name ?? '' }}" required/>
                            <label class="mdl-textfield__label" for="name">Nome</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="team_id" name="team_id" required>
                                <option style="width: 400px"></option>
                                @foreach ($teams as $team)
                                    <option
                                        style="width: 400px"
                                        value="{{ $team->id }}"
                                        {{  isset($player) && $team->id === $player->team->id ? 'selected' : null }}
                                    >
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="country_id">Time</label>
                        </div>

                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="country_team_id" name="country_team_id">
                                <option style="width: 400px"></option>
                                @foreach ($country_teams as $country_team)
                                    <option
                                        style="width: 400px"
                                        value="{{ $country_team->id }}"
                                        {{  isset($player) && $country_team->id === $player->country_team->id ? 'selected' : null }}
                                    >
                                        {{ $country_team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="country_team_id">Sele????o Nacional</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="country_id" name="country_id" required>
                                <option style="width: 400px"></option>
                                @foreach ($countries as $country)
                                    <option
                                        style="width: 400px"
                                        value="{{ $country->id }}"
                                        {{  isset($player) && $country->id === $player->country->id ? 'selected' : null }}
                                    >
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="country_id">Pa??s</label>
                        </div>

                        <ul class="mdl-list">
                            @foreach ($positions as $position)
                                <li class="mdl-list__item">
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-{{ $position }}">
                                        <input
                                            type="radio"
                                            id="option-{{ $position }}"
                                            class="mdl-radio__button"
                                            name="position"
                                            value="{{ $position }}"
                                            {{ isset($player) && $player->position === $position ? 'checked' : null }}
                                            required
                                        >
                                        <span class="mdl-radio__label" style="font-size: 12px">{{ $position }}</span>
                                    </label>
                                </li>
                                <hr/>
                            @endforeach
                        </ul>

                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary"
                            style="position: fixed; display: block; right: 0; bottom: 0; margin-right: 40px; margin-bottom: 30px;z-index: 900;"
                            type="submit"
                    >
                        <i class="material-icons">done</i>
                    </button>

                    @isset($player)
                        <button
                            id="show-dialog"
                            type="button"
                            class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--red-500"
                            style="position: fixed; display: block; right: 0; bottom: 0; margin-right: 120px; margin-bottom: 30px;z-index: 900;"
                        >
                            <i class="material-icons">delete</i>
                        </button>
                    @endisset
                </form>
            </div>
        </div>


    @isset($player)
        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__title">Confirmar</h4>
            <div class="mdl-dialog__content">
                <p> Deletar {{ $player->name ?? '' }} ? </p>
            </div>
            <div class="mdl-dialog__actions">
                    <form action="{{ route('adm.player.destroy', ['player' => $player ?? null ]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-color--red-500"><i class="material-icons">check</i></button>
                    </form>
                    <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-color--green-500 close"><i class="material-icons">close</i></button>
            </div>
        </dialog>

        <script>
            var dialog = document.querySelector('dialog');
            var showDialogButton = document.querySelector('#show-dialog');
            if (! dialog.showModal) {
                dialogPolyfill.registerDialog(dialog);
            }
            showDialogButton.addEventListener('click', function() {
                dialog.showModal();
            });
            dialog.querySelector('.close').addEventListener('click', function() {
                dialog.close();
            });
        </script>
    @endisset

@endsection
