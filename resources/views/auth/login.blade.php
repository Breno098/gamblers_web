@extends('auth.layout', [ 'title' => 'Login'] )

@section('content')
    <div class="mdl-layout mdl-js-layout">
        <div
            class="mdl-card mdl-shadow--16dp"
            style="overflow: visible !important; z-index: auto !important; padding: 30px; margin: auto;"
        >
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div id="login-fab" class="mdl-color--primary mdl-color-text--white">
                        <i style="line-height: 56px;" class="material-icons">lock</i>
                    </div>
                    <div style="font-size: 28px; font-weight: 600; padding: 30px; text-align: center" class="mdl-color-text--primary">
                        Gamblers
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="email" name="email"/>
                        <label class="mdl-textfield__label" for="email">Email</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                        <label class="mdl-textfield__label" for="password">Senha</label>
                    </div>
                    @if (session('error_login'))
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <p class="mdl-color-text--primary">{{ session('error_login') }}</p>
                            </div>
                        </div>
                    @endif

                    <button
                        style="width: 100%; height: 40px; min-width: initial;"
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white"
                        type="submit"
                    >
                            Entrar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div>
        <div class="mdl-card__actions">
            <a class="mdl-button mdl-js-button mdl-button--primary" href="{{ route('register') }}">
                Registrar-se
            </a>
            @if($forgot_password ?? false)
                <button class="mdl-button mdl-js-button mdl-button--primary">
                    Esqueci a senha
                </button>
            @endif
        </div>
    </div>
@endsection
