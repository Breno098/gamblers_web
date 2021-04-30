@extends('auth.layout')

@section('content')
    <div class="mdl-layout mdl-js-layout">
        <div
            class="mdl-card mdl-shadow--16dp mdl-cell--6-col"
            style="overflow: visible !important; z-index: auto !important; padding: 10px; margin: auto;"
        >
            <div class="mdl-card__supporting-text">
                <div id="login-fab" class="mdl-color--primary mdl-color-text--white">
                    <i style="line-height: 56px;" class="material-icons">person_add</i>
                </div>

                <div style="font-size: 28px; font-weight: 600; padding: 30px; text-align: center" class="mdl-color-text--primary">
                    Registre-se
                </div>
            </div>
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                        <input class="mdl-textfield__input" id="name" name="name" required/>
                        <label class="mdl-textfield__label" for="name">Nome</label>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                        <input class="mdl-textfield__input" id="email" name="email" required/>
                        <label class="mdl-textfield__label" for="email">Email</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                        <input class="mdl-textfield__input" type="password" id="password" name="password" required/>
                        <label class="mdl-textfield__label" for="password">Senha</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                        <input class="mdl-textfield__input" type="password" id="password_confirmation" name="password_confirmation" required/>
                        <label class="mdl-textfield__label" for="password_confirmation">Confirme a senha</label>
                    </div>
                    @if (session('error_register'))
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <p class="mdl-color-text--primary">{{ session('error_register') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="mdl-card__supporting-text" style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>
                            <p> Escolha seu avatar </p>
                        </div>
                        <div style="display: flex; flex-direction: row; justify-content: space-between;">
                            <p> Arraste </p>  &nbsp;
                            <i class="material-icons">arrow_forward</i>
                        </div>
                    </div>

                    <div class="mdl-card__supporting-text" >
                        <div style="overflow: auto; white-space: nowrap;">
                            @foreach ($avatars as $avatar)
                                <a style="display: inline-block; padding: 14px; 0">
                                    <img
                                        class="avatar"
                                        src="{{ asset('storage/avatar/' . $avatar ) }}"
                                        alt="avatar"
                                        style="height: 100%; width: 120px; border-radius: 50%;"
                                    />
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <button
                        style="width: 100%; height: 40px; min-width: initial;"
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white"
                        type="submit"
                    >
                            Registrar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
