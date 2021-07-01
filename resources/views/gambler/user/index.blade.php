@extends('gambler.layout', ['title' => 'Meu perfil'])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>Informações</strong>
                </h1>
            </div>
            <div class="mdl-card__supporting-text">
                Altere seus dados (nome, email e senha) e seu AVATAR.
            </div>
            <div class="mdl-card__supporting-text" style="width: 97%">
                <div>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--raised" href="{{ route('user.info') }}">
                        Alterar dados
                    </a>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>Pontuações</strong>
                </h1>
            </div>
            <div class="mdl-card__supporting-text">
                Veja as pontuções que você fez nas competições
            </div>
            <div class="mdl-card__supporting-text" style="width: 97%">
                <div>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--raised" href="{{ route('user.scores') }}">
                        Pontuações
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
