@extends('adm.layout', ['title' => 'Usuários'])

@section('content')
    <div class="mdl-grid">
        @foreach ($users as $user)
            <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card">
                <div class="mdl-card__supporting-text">
                    <div style="background: rgba(0, 0 , 0, 0.05); display: flex; align-items: center; justify-content: center; border-radius: 50%; margin: 25px auto 0; padding: 15px; width: 250px; height: 250px;">
                            <img
                                src="{{ asset('storage/avatar/' . $user->avatar ) }}"
                                alt="avatar"
                                style="height: 250px; width: 200px; "
                            />
                    </div>

                    <div style="display: flex; align-items: center; justify-content: center; margin: 0 auto; padding: 15px; width: 250px; flex-direction: column">
                        <strong style="text-align: center;">{{ $user->name }}</strong>
                        <strong style="text-align: center; margin-top: 10px">{{ $user->email }}</strong>

                        <a
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                            href="{{ route('adm.user.info', [ 'user' => $user ]) }}"
                            style="width: 100%; height: 40px; min-width: initial; ; margin-top: 10px"
                        >
                            <i class="material-icons">info</i>
                            <span class="mdc-button__label">Ver mais infomações</span>
                        </a>
                    </div>

                </div>
            </div>
        @endforeach

        <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card">
                <div class="mdl-card__actions" style="width: 100%; justify-content: flex-end; display: flex">
                    <div>
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $users->previousPageUrl() ? 'mdl-button--primary' : '' }}"
                        {{ $users->previousPageUrl() ?? 'disabled' }}
                        href="{{ $users->previousPageUrl() ?: '#' }}"
                    >
                        <span class="material-icons"> arrow_back_ios </span>
                    </a>
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $users->nextPageUrl() ? 'mdl-button--primary' : '' }}"
                        {{ $users->nextPageUrl() ?? 'disabled' }}
                        href="{{ $users->nextPageUrl() ?: '#' }}"
                    >
                        <span class="material-icons"> arrow_forward_ios </span>
                    </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
            href="{{ route('adm.user.create')}}"
            style="position: fixed; display: block; left: 0; bottom: 0; margin-left: 40px; margin-bottom: 40px;z-index: 900;">

            <i class="material-icons">add</i>
        </a> --}}
    </div>
@endsection
