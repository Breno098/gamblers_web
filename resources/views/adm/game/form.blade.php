@extends('adm.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>{{ isset($game) ? 'Alterar' : 'Cadastrar' }}</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                <form
                    action="{{ isset($game) ? route('adm.game.update', ['game' => $game]) : route('adm.game.store') }}"
                    method="POST"
                >

                    @method( isset($game) ? 'PUT' : 'POST')
                    <div style="display: flex; flex-direction: column">
                        @csrf
                        <input name="id" id="id" hidden value="{{ $game->id ?? '' }}"/>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input type="date" class="mdl-textfield__input" name="date" id="date" value="{{ isset($game) ? $game->date->format('Y-m-d') : now()->format('Y-m-d') }}" required/>
                            <label class="mdl-textfield__label" for="date">Data</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input type="time" class="mdl-textfield__input" name="time" id="time" value="{{ isset($game) ? $game->time->format('H:m') : '17:00' }}" required/>
                            <label class="mdl-textfield__label" for="time">Hora</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="team_home_id" name="team_home_id" required>
                                <option></option>
                                @foreach ($teams as $team)
                                    <option
                                        value="{{ $team->id }}"
                                        {{  isset($game) && $team->id === $game->team_home_id ? 'selected' : null }}
                                    >
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="team_home_id">Time da Casa</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="team_guest_id" name="team_guest_id" required>
                                <option></option>
                                @foreach ($teams as $team)
                                    <option
                                        value="{{ $team->id }} "
                                        {{  isset($game) && $team->id === $game->team_guest_id ? 'selected' : null }}
                                    >
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="team_guest_id">Time Visitante</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="stadium_id" name="stadium_id" required>
                                <option></option>
                                @foreach ($stadia as $stadium)
                                    <option
                                        value="{{ $stadium->id }}"
                                        {{  isset($game) && $stadium->id === $game->stadium_id ? 'selected' : null }}
                                    >
                                        {{ $stadium->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="stadium_id">Estádio</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="competition_id" name="competition_id" required>
                                <option style="width: 400px"></option>
                                @foreach ($competitions as $competition)
                                    <option
                                        style="width: 400px"
                                        value="{{ $competition->id }}"
                                        {{  isset($game) && $competition->id === $game->competition_id ? 'selected' : null }}
                                    >
                                        {{ $competition->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="competition_id">Competição</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="stage" name="stage" required>
                                <option></option>
                                @foreach ($stages as $stage)
                                    <option
                                        value="{{ $stage }}"
                                        {{  isset($game) && $stage === $game->stage ? 'selected' : null }}
                                    >
                                        {{ Str::ucfirst($stage) }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mdl-textfield__label" for="stage">Fase</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <select class="mdl-textfield__input" id="status" name="status" required>
                                <option value="open" {{  isset($game) && $game->status === 'open' ? 'selected' : null }}>
                                    Aberto
                                </option>
                                <option value="finished" {{  isset($game) && $game->status === 'finished' ? 'selected' : null }}>
                                    Finalizado
                                </option>
                            </select>
                            <label class="mdl-textfield__label" for="status">Status</label>
                        </div>


                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary"
                            style="position: fixed; display: block; right: 0; bottom: 0; margin-right: 40px; margin-bottom: 30px;z-index: 900;"
                            type="submit"
                    >
                        <i class="material-icons">done</i>
                    </button>

                    @isset($game)
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


    @isset($game)
        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__title">Confirmar</h4>
            <div class="mdl-dialog__content">
                <p> Deletar {{ $game->name ?? '' }} ? </p>
            </div>
            <div class="mdl-dialog__actions">
                    <form action="{{ route('adm.game.destroy', ['game' => $game ?? null ]) }}" method="POST">
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
