@extends('gambler.layout', ['title' => 'Meus dados'])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>Meus dados</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                <div class="mdl-card__supporting-text">
                    <div style="background: rgba(0, 0 , 0, 0.05); display: flex; align-items: center; justify-content: center; border-radius: 50%; margin: 25px auto 0; padding: 15px; width: 250px; height: 250px;">
                            <img
                                src="{{ asset('storage/avatar/' . $user->avatar ) }}"
                                alt="avatar"
                                style="height: 250px; width: 200px; "
                            />
                    </div>
    
                    <div style="display: flex; align-items: center; justify-content: center; margin: 0 auto; padding: 15px; width: 250px; flex-direction: column">
                        <a
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                            style="height: 40px;"
                            href="{{ route('user.avatar') }}"
                        >
                            <span class="mdc-button__label">Alterar avatar</span>
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('user.update', ['user' => $user]) }}">
                    @csrf
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                        <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                        <label class="mdl-textfield__label" for="password">Senha atual</label>
                    </div>
                    @if(session()->has('error_password')) 
                        {{ session()->get('error_password') }}
                    @endif

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%; margin: 10px 0 0 0">
                        <input class="mdl-textfield__input" id="name" name="name" value="{{ $user->name ?? '' }}" required/>
                        <label class="mdl-textfield__label" for="name">Nome</label>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                        <input class="mdl-textfield__input" id="email" name="email" value="{{ $user->email ?? '' }}" required/>
                        <label class="mdl-textfield__label" for="email">Email</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                        <input class="mdl-textfield__input" type="password" id="new_password" name="new_password"/>
                        <label class="mdl-textfield__label" for="new_password">Nova Senha</label>
                    </div>
                    @if(session()->has('error_new_password')) 
                        {{ session()->get('error_new_password') }}
                    @endif

                    <button
                        style="width: 100%; height: 40px; min-width: initial;"
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white"
                        type="submit"
                    >
                            Alterar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
