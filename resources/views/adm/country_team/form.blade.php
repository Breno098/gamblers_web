@extends('adm.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>{{ isset($country_team) ? 'Alterar' : 'Cadastrar' }}</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                <form
                    action="{{ isset($country_team) ? route('adm.country_team.update', ['country_team' => $country_team]) : route('adm.country_team.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @method( isset($country_team) ? 'PUT' : 'POST')
                    <div style="display: flex; flex-direction: column">
                        @csrf
                        <input name="id" id="id" hidden value="{{ $country_team->id ?? '' }}"/>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input class="mdl-textfield__input" name="name" id="name" value="{{ $country_team->name ?? '' }}" required/>
                            <label class="mdl-textfield__label" for="name">Nome</label>
                        </div>

                        <img
                            src="{{ asset(isset($country_team) && $country_team->name_photo ? 'storage/teams/' . $country_team->name_photo : 'storage/app/default_team.jpg') }}"
                            style="max-height: 500px; max-width: 500px"
                            id="photo_team"
                        />

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-textfield--file" style="width: 100%">
                            <div class="mdl-button mdl-button--icon mdl-button--file">
                              <i class="material-icons">attach_file</i>
                              <input type="file" name="photo" id="photo" />
                            </div>
                        </div>

                        <script>
                            document.querySelector('#photo').onchange = function(event){
                                showThumbnail(this.files);
                            };

                            function showThumbnail(files) {
                                if (files && files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        document.querySelector('#photo_team').src = e.target.result;
                                    }
                                    reader.readAsDataURL(files[0]);
                                }
                            }
                        </script>

                        <ul class="mdl-list">
                                @foreach ($competitions as $competition)
                                <li class="mdl-list__item">
                                    <span class="mdl-list__item-primary-content">
                                        {{ $competition->name }} | {{ $competition->season }}
                                    </span>
                                    <span class="mdl-list__item-secondary-action">
                                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="competitions-{{ $competition->id }}">
                                        <input
                                            type="checkbox"
                                            name="competitions[{{ $competition->id }}]"
                                            id="competitions-{{ $competition->id }}"
                                            class="mdl-switch__input"
                                            @isset($country_team)
                                                @foreach ($country_team->competitions as $comp)
                                                    {{ isset($country_team) && $competition->id === $comp->id ? 'checked' : null }}
                                                @endforeach
                                            @endisset

                                        />
                                        </label>
                                    </span>
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

                    @isset($country_team)
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


    @isset($country_team)
        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__title">Confirmar</h4>
            <div class="mdl-dialog__content">
                <p> Deletar {{ $country_team->name ?? '' }} ? </p>
            </div>
            <div class="mdl-dialog__actions">
                    <form action="{{ route('adm.country_team.destroy', ['country_team' => $country_team ?? null ]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-color--red-500"><i class="material-icons">check</i></button>
                    </form>
                    <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-color--green-500 close"><i class="material-icons">close</i></button>
            </div>
        </dialog>
    @endisset

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
@endsection
