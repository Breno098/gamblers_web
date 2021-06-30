@extends('adm.layout', ['title' => "Informações de {$user->name} | {$competition->name}"])

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">

            <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--16dp" >
                <div class="mdl-card__title">
                    <h1 class="mdl-card__title-text" style="padding: 0px 20px;">
                        <strong>{{ $user->name }}</strong>
                    </h1>
                </div>

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
            </div>

            @foreach ($scores as $score)
                <div class="mdl-cell mdl-cell--12-col mdl-card  mdl-shadow--16dp">
                    <div class="mdl-card__title">
                        <h1 class="mdl-card__title-text" style="padding: 0px 20px;">
                            <strong>{{ $score->team_home_name }} X {{ $score->team_guest_name }}</strong>
                        </h1>
                    </div>
                    <div class="mdl-card__title">
                        <h1 class="mdl-card__title-text" style="padding: 0px 20px;">
                            <strong> {{ $score->date }}</strong>
                        </h1>
                    </div>
                    <div class="mdl-card__supporting-text" style="width: 95%">
                        <ul class="mdl-list">
                            @php
                                $total_score = 0
                            @endphp
                                @foreach (json_decode($score->report) as $report)
                                    @isset($report->score)
                                        <hr/>
                                        <li class="mdl-list__item mdl-list__item--one-line">
                                            <span class="mdl-list__item-secondary-content">
                                                {{ number_format($report->score, 2, '.', '') }}
                                            </span>
                                            <span class="mdl-list__item-text-body">
                                                &nbsp; {{ $report->description }}
                                            </span>
                                        </li>
                                        @php
                                            $total_score += $report->score
                                        @endphp
                                    @else
                                        <span class="mdl-list__item-text-body">
                                            &nbsp; <strong> Nenhum ponto feito </strong>
                                        </span>
                                    @endisset
                                @endforeach
                            <hr/>
                            <li class="mdl-list__item mdl-list__item--one-line mdl-color--accent">
                                <span class="mdl-list__item-secondary-content">
                                    <strong> {{ number_format($total_score, 2, '.', '') }} </strong>
                                </span>
                                <span class="mdl-list__item-text-body">
                                    &nbsp; <strong> Total </strong>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
