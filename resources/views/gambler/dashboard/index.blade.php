@extends('gambler.layout', ['title' => 'Inicio'])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>Ranking</strong>
                </h1>
            </div>
            <div class="mdl-card__supporting-text">
                Veja o ranking das pontuações do(a) 
                @isset($competitions[0])
                    {{ $competitions[0]->name }}
                @endisset
                @isset($competitions[1])
                    , {{ $competitions[1]->name }}
                @endisset
                @isset($competitions[2])
                    , {{ $competitions[2]->name }}
                @endisset
               e muito mais. 
            </div>
            <div class="mdl-card__supporting-text" style="width: 97%">
                <div>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--raised" href="{{ route('ranking.index') }}">
                        Ver ranking's
                    </a>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">
                    <strong>Perfil</strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                Para alterações de nome, email, senha e AVATAR, acesse seu perfil e deixe do seu jeito.
            </div>
              
            <div class="mdl-card__supporting-text" style="width: 97%">
                <div>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--raised" href="{{ route('user.index') }}">
                        Meu perfil
                    </a>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
            <div
                class="mdl-card__title"
                style="height: 300px; background: url('{{ asset('storage/app/score-rules.jpg') }}') center / cover;"
            >
                <h1
                    class="mdl-card__title-text"
                    style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px;"
                >
                    <strong>Regras</strong>
                </h1>
            </div>
            <div class="mdl-card__supporting-text" style="width: 97%">
                <ul class="mdl-list">
                    @foreach ($rules as $rule)
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <i class="material-icons">star</i>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; {{ $rule['score'] }} | {{ $rule['description'] }}
                            </span>
                        </li>
                        <hr/>
                    @endforeach
                </ul>

                {{-- <div>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--raised">
                        Ver regulamento
                    </a>
                </div> --}}
            </div>
            
        </div>
    </div>
@endsection
