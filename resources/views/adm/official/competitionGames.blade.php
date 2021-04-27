@extends('adm.layout')

@section('content')
    <div class="mdl-grid" style="display: flex; justify-content: center">

        @foreach ($games as $game)
            <a
                class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--16dp"
                href="#"
                style="text-decoration: none"
            >
                <div
                    class="mdl-card__supporting-text"
                    style="display: flex; flex-direction: row; justify-content: space-between;"
                >
                    <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--16dp" style="height: 200px;">
                        <div
                            class="mdl-card__title"
                            style="
                                width: 256px;
                                height: 256px;
                                background: url('{{  asset('storage/teams/' . $game->teamHome->name_photo) }}') center / cover;
                            ">
                            <h6
                                class="mdl-card__title-text"
                                style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px; position: absolute; top: 0">
                                <strong> {{ $game->teamHome->name }} </strong>
                            </h6>
                        </div>
                    </div>

                    <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--16dp" style="height: 200px;">
                        <div
                            class="mdl-card__title"
                            style="
                                width: 256px;
                                height: 256px;
                                background: url('{{  asset('storage/teams/' . $game->teamGuest->name_photo) }}') center / cover;
                            ">
                            <h6
                                class="mdl-card__title-text"
                                style="color: #000; background: rgba(255, 255, 255, 0.8); padding: 5px 20px; position: absolute; top: 0">
                                <strong> {{ $game->teamGuest->name }} </strong>
                            </h6>
                        </div>
                    </div>
                </div>

                <div
                    class="mdl-card__title"
                    style="display: flex; flex-direction: row; justify-content: space-between"
                >

                </div>

            </a>
        @endforeach

    </div>
@endsection
