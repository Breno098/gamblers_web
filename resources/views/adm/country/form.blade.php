@extends('adm.layout', ['title' => isset($country) ? 'Alterar País' : 'Cadastrar País' ])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>{{ isset($country) ? 'Alterar País' : 'Cadastrar País' }}</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                <form
                    action="{{ isset($country) ? route('adm.country.update', ['country' => $country]) : route('adm.country.store') }}"
                    method="POST"
                >
                    @method( isset($country) ? 'PUT' : 'POST')
                    <div style="display: flex; flex-direction: column">
                        @csrf
                        <input name="id" id="id" hidden value="{{ $country->id ?? '' }}"/>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input class="mdl-textfield__input" name="name" id="name" value="{{ $country->name ?? '' }}" required/>
                            <label class="mdl-textfield__label" for="name">Nome</label>
                        </div>

                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary"
                            style="position: fixed; display: block; right: 0; bottom: 0; margin-right: 40px; margin-bottom: 30px;z-index: 900;"
                            type="submit"
                    >
                        <i class="material-icons">done</i>
                    </button>

                    @isset($country)
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


    @isset($country)
        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__title">Confirmar</h4>
            <div class="mdl-dialog__content">
                <p> Deletar {{ $country->name ?? '' }} ? </p>
            </div>
            <div class="mdl-dialog__actions">
                    <form action="{{ route('adm.country.destroy', ['country' => $country ?? null ]) }}" method="POST">
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
