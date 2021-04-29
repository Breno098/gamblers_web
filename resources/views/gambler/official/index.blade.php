@extends('gambler.layout')

@section('content')
    <div class="mdl-grid" style="display: flex; justify-content: center">

        @foreach ($competitions as $competition)
            <a
                class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--16dp"
                href="{{ route('official.competitionGames', ['competition' => $competition]) }}"
                style="text-decoration: none"
            >
                <div
                    class="mdl-card__title"
                    style="height: 450px; background: url('{{ asset('storage/competitions/' . $competition->name_photo) }}') center / cover;"
                >
                    <h1
                        class="mdl-card__title-text"
                        style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px;"
                    >
                        <strong> {{ $competition->name }} | {{ $competition->season }} </strong>
                    </h1>
                </div>
            </a>
        @endforeach

    </div>
@endsection
