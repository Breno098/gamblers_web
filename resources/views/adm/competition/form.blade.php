@extends('adm.layout', ['title' => isset($competition) ? 'Alterar Competição' : 'Cadastrar Competição' ])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>{{ isset($competition) ? 'Alterar Competição' : 'Cadastrar Competição' }}</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                <form
                    action="{{ isset($competition) ? route('adm.competition.update', ['competition' => $competition]) : route('adm.competition.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @method( isset($competition) ? 'PUT' : 'POST')
                    <div style="display: flex; flex-direction: column">
                        @csrf
                        <input name="id" id="id" hidden value="{{ $competition->id ?? '' }}"/>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input class="mdl-textfield__input" name="name" id="name" value="{{ $competition->name ?? '' }}" required/>
                            <label class="mdl-textfield__label" for="name">Nome</label>
                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input class="mdl-textfield__input" name="season" id="season" value="{{ $competition->season ?? '' }}" required/>
                            <label class="mdl-textfield__label" for="season">Temporada</label>
                        </div>

                        <img
                            src="{{ asset(isset($competition) && $competition->name_photo ? 'storage/competitions/' . $competition->name_photo : 'storage/app/default_competition.jpg') }}"
                            style="max-height: 700px; max-width: 1200px"
                            id="photo_competition"
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
                                        document.querySelector('#photo_competition').src = e.target.result;
                                    }
                                    reader.readAsDataURL(files[0]);
                                }
                            }
                        </script>
                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary"
                            style="position: fixed; display: block; right: 0; bottom: 0; margin-right: 40px; margin-bottom: 30px;z-index: 900;"
                            type="submit"
                    >
                        <i class="material-icons">done</i>
                    </button>

                    @isset($competition)
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


    @isset($competition)
        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__title">Confirmar</h4>
            <div class="mdl-dialog__content">
                <p> Deletar {{ $competition->name ?? '' }} ? </p>
            </div>
            <div class="mdl-dialog__actions">
                    <form action="{{ route('adm.competition.destroy', ['competition' => $competition ]) }}" method="POST">
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
