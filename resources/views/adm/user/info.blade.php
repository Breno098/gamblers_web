@extends('adm.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text" style="display: flex; flex-direction: column;">
                    <strong>{{ $user->name }}</strong>
                    <strong>{{ $user->email }}</strong>
                </h1>
            </div>

            <ul class="mdl-list">
                @foreach ($userScoreBoards as $score)
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <strong>{{ $score->competition_name }} | {{ $score->competition_season }}</strong>
                        </span>
                        <span class="mdl-list__item-secondary-action">
                            {{ $score->total_score }}
                        </span>
                    </li>
                    <hr/>
                @endforeach
            </ul>

            <div class="mdl-card__supporting-text">
            </div>
        </div>
    </div>
@endsection
