@extends('adm.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-card">
            <div class="mdl-card__supporting-text">
                <div style="display: flex; flex-direction: column">
                    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--16dp">
                        <div
                            class="mdl-card__title"
                            style="display: flex; justify-content: space-between; align-items: center"
                        >
                            <div
                                class="mdl-card__title-text"
                                style="padding: 0px 20px; display: flex; align-items: center; justify-content: space-between; width: 100% "
                            >
                                <div style="display: flex; align-items: center;">
                                    <img
                                        src="{{ asset('storage/teams/' . $game->teamHome->name_photo) }}"
                                        style="width: 50px; height: 50px;"
                                    />
                                    <strong> {{ $game->teamHome->name }} </strong>
                                </div>

                                <div>
                                    <strong id="score_team_home"> 0 </strong>
                                </div>

                            </div>
                        </div>

                        <div class="mdl-card__title">
                            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                                <div class="mdl-tabs__tab-bar">
                                    <a href="#ata-team_home" class="mdl-tabs__tab is-active">ATA</a>
                                    <a href="#mei-team_home" class="mdl-tabs__tab">MEI</a>
                                    <a href="#vol-team_home" class="mdl-tabs__tab">VOL</a>
                                    <a href="#lt-team_home" class="mdl-tabs__tab">LT</a>
                                    <a href="#zag-team_home" class="mdl-tabs__tab">ZAG</a>
                                    <a href="#go-team_home" class="mdl-tabs__tab">GO</a>
                                </div>

                                <div class="mdl-tabs__panel is-active" id="ata-team_home">
                                   @foreach ($game->teamHome->players()->where('position', 'ATA')->get() as $player)
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <div
                                                    class="material-icons mdl-badge mdl-badge--overlap"
                                                    data-badge="0"
                                                    id="count_goals_{{ $player->id }}"
                                                >sports_soccer</div>
                                            </span>
                                            <span class="mdl-list__item-primary-content">
                                                {{ $player->name }}
                                            </span>
                                            <span class="mdl-list__item-secondary-action">
                                                <button
                                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                    onclick="addGoalTeamHome({{ $player->toJson() }})"
                                                >
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </span>
                                        </li>
                                        <hr class="mdl-color--red-500"/>
                                    @endforeach
                                </div>
                                <div class="mdl-tabs__panel" id="mei-team_home">
                                @foreach ($game->teamHome->players()->where('position', 'MEI')->get() as $player)
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <div
                                                    class="material-icons mdl-badge mdl-badge--overlap"
                                                    data-badge="0"
                                                    id="count_goals_{{ $player->id }}"
                                                >sports_soccer</div>
                                            </span>
                                            <span class="mdl-list__item-primary-content">

                                                {{ $player->name }}
                                            </span>
                                            <span class="mdl-list__item-secondary-action">
                                                <button
                                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                    onclick="addGoalTeamHome({{ $player->toJson() }})"
                                                >
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </span>
                                        </li>
                                        <hr class="mdl-color--green-500"/>
                                    @endforeach
                                </div>
                                <div class="mdl-tabs__panel" id="vol-team_home">
                                @foreach ($game->teamHome->players()->where('position', 'VOL')->get() as $player)
                                    <li class="mdl-list__item">
                                        <span class="mdl-list__item-primary-content">
                                            <div
                                                class="material-icons mdl-badge mdl-badge--overlap"
                                                data-badge="0"
                                                id="count_goals_{{ $player->id }}"
                                            >sports_soccer</div>
                                        </span>
                                        <span class="mdl-list__item-primary-content">
                                            {{ $player->name }}
                                        </span>
                                        <span class="mdl-list__item-secondary-action">
                                            <button
                                                class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                onclick="addGoalTeamHome({{ $player->toJson() }})"
                                            >
                                                <i class="material-icons">add</i>
                                            </button>
                                        </span>
                                    </li>
                                    <hr class="mdl-color--green-500"/>
                                    @endforeach
                                </div>
                                <div class="mdl-tabs__panel" id="lt-team_home">
                                @foreach ($game->teamHome->players()->where('position', 'LT')->get() as $player)
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <div
                                                    class="material-icons mdl-badge mdl-badge--overlap"
                                                    data-badge="0"
                                                    id="count_goals_{{ $player->id }}"
                                                >sports_soccer</div>
                                            </span>
                                            <span class="mdl-list__item-primary-content">
                                                {{ $player->name }}
                                            </span>
                                            <span class="mdl-list__item-secondary-action">
                                                <button
                                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                    onclick="addGoalTeamHome({{ $player->toJson() }})"
                                                >
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </span>
                                        </li>
                                    <hr class="mdl-color--blue-500"/>
                                    @endforeach
                                </div>
                                <div class="mdl-tabs__panel" id="zag-team_home">
                                @foreach ($game->teamHome->players()->where('position', 'ZAG')->get() as $player)
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <div
                                                    class="material-icons mdl-badge mdl-badge--overlap"
                                                    data-badge="0"
                                                    id="count_goals_{{ $player->id }}"
                                                >sports_soccer</div>
                                            </span>
                                            <span class="mdl-list__item-primary-content">
                                                {{ $player->name }}
                                            </span>
                                            <span class="mdl-list__item-secondary-action">
                                                <button
                                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                    onclick="addGoalTeamHome({{ $player->toJson() }})"
                                                >
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </span>
                                        </li>
                                        <hr class="mdl-color--blue-500"/>
                                    @endforeach
                                </div>
                                <div class="mdl-tabs__panel" id="go-team_home">
                                @foreach ($game->teamHome->players()->where('position', 'GO')->get() as $player)
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <div
                                                    class="material-icons mdl-badge mdl-badge--overlap"
                                                    data-badge="0"
                                                    id="count_goals_{{ $player->id }}"
                                                >sports_soccer</div>
                                            </span>
                                            <span class="mdl-list__item-primary-content">
                                                {{ $player->name }}
                                            </span>
                                            <span class="mdl-list__item-secondary-action">
                                                <button
                                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                    onclick="addGoalTeamHome({{ $player->toJson() }})"
                                                >
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </span>
                                        </li>
                                        <hr class="mdl-color--brown-500"/>
                                    @endforeach
                                </div>
                            </div>

                        </div>


                        <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--16dp">
                            <div
                                class="mdl-card__title"
                                style="display: flex; justify-content: space-between; align-items: center"
                            >
                                <div
                                    class="mdl-card__title-text"
                                    style="padding: 0px 20px; display: flex; align-items: center; justify-content: space-between; width: 100% "
                                >
                                    <div style="display: flex; align-items: center;">
                                        <img
                                            src="{{ asset('storage/teams/' . $game->teamGuest->name_photo) }}"
                                            style="width: 50px; height: 50px;"
                                        />
                                        <strong> {{ $game->teamGuest->name }} </strong>
                                    </div>

                                    <div>
                                        <strong id="score_team_guest"> 0 </strong>
                                    </div>

                                </div>
                            </div>

                            <div class="mdl-card__title">
                                <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                                    <div class="mdl-tabs__tab-bar">
                                        <a href="#ata-team_home" class="mdl-tabs__tab is-active">ATA</a>
                                        <a href="#mei-team_home" class="mdl-tabs__tab">MEI</a>
                                        <a href="#vol-team_home" class="mdl-tabs__tab">VOL</a>
                                        <a href="#lt-team_home" class="mdl-tabs__tab">LT</a>
                                        <a href="#zag-team_home" class="mdl-tabs__tab">ZAG</a>
                                        <a href="#go-team_home" class="mdl-tabs__tab">GO</a>
                                    </div>

                                    <div class="mdl-tabs__panel is-active" id="ata-team_home">
                                       @foreach ($game->teamGuest->players()->where('position', 'ATA')->get() as $player)
                                            <li class="mdl-list__item">
                                                <span class="mdl-list__item-primary-content">
                                                    <div
                                                        class="material-icons mdl-badge mdl-badge--overlap"
                                                        data-badge="0"
                                                        id="count_goals_{{ $player->id }}"
                                                    >sports_soccer</div>
                                                </span>
                                                <span class="mdl-list__item-primary-content">
                                                    {{ $player->name }}
                                                </span>
                                                <span class="mdl-list__item-secondary-action">
                                                    <button
                                                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                        onclick="addGoalTeamGuest({{ $player->toJson() }})"
                                                    >
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </span>
                                            </li>
                                            <hr class="mdl-color--red-500"/>
                                        @endforeach
                                    </div>
                                    <div class="mdl-tabs__panel" id="mei-team_home">
                                    @foreach ($game->teamGuest->players()->where('position', 'MEI')->get() as $player)
                                            <li class="mdl-list__item">
                                                <span class="mdl-list__item-primary-content">
                                                    <div
                                                        class="material-icons mdl-badge mdl-badge--overlap"
                                                        data-badge="0"
                                                        id="count_goals_{{ $player->id }}"
                                                    >sports_soccer</div>
                                                </span>
                                                <span class="mdl-list__item-primary-content">

                                                    {{ $player->name }}
                                                </span>
                                                <span class="mdl-list__item-secondary-action">
                                                    <button
                                                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                        onclick="addGoalTeamGuest({{ $player->toJson() }})"
                                                    >
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </span>
                                            </li>
                                            <hr class="mdl-color--green-500"/>
                                        @endforeach
                                    </div>
                                    <div class="mdl-tabs__panel" id="vol-team_home">
                                    @foreach ($game->teamGuest->players()->where('position', 'VOL')->get() as $player)
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                                <div
                                                    class="material-icons mdl-badge mdl-badge--overlap"
                                                    data-badge="0"
                                                    id="count_goals_{{ $player->id }}"
                                                >sports_soccer</div>
                                            </span>
                                            <span class="mdl-list__item-primary-content">
                                                {{ $player->name }}
                                            </span>
                                            <span class="mdl-list__item-secondary-action">
                                                <button
                                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                    onclick="addGoalTeamGuest({{ $player->toJson() }})"
                                                >
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </span>
                                        </li>
                                        <hr class="mdl-color--green-500"/>
                                        @endforeach
                                    </div>
                                    <div class="mdl-tabs__panel" id="lt-team_home">
                                    @foreach ($game->teamGuest->players()->where('position', 'LT')->get() as $player)
                                            <li class="mdl-list__item">
                                                <span class="mdl-list__item-primary-content">
                                                    <div
                                                        class="material-icons mdl-badge mdl-badge--overlap"
                                                        data-badge="0"
                                                        id="count_goals_{{ $player->id }}"
                                                    >sports_soccer</div>
                                                </span>
                                                <span class="mdl-list__item-primary-content">
                                                    {{ $player->name }}
                                                </span>
                                                <span class="mdl-list__item-secondary-action">
                                                    <button
                                                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                        onclick="addGoalTeamGuest({{ $player->toJson() }})"
                                                    >
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </span>
                                            </li>
                                        <hr class="mdl-color--blue-500"/>
                                        @endforeach
                                    </div>
                                    <div class="mdl-tabs__panel" id="zag-team_home">
                                    @foreach ($game->teamGuest->players()->where('position', 'ZAG')->get() as $player)
                                            <li class="mdl-list__item">
                                                <span class="mdl-list__item-primary-content">
                                                    <div
                                                        class="material-icons mdl-badge mdl-badge--overlap"
                                                        data-badge="0"
                                                        id="count_goals_{{ $player->id }}"
                                                    >sports_soccer</div>
                                                </span>
                                                <span class="mdl-list__item-primary-content">
                                                    {{ $player->name }}
                                                </span>
                                                <span class="mdl-list__item-secondary-action">
                                                    <button
                                                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                        onclick="addGoalTeamGuest({{ $player->toJson() }})"
                                                    >
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </span>
                                            </li>
                                            <hr class="mdl-color--blue-500"/>
                                        @endforeach
                                    </div>
                                    <div class="mdl-tabs__panel" id="go-team_home">
                                    @foreach ($game->teamGuest->players()->where('position', 'GO')->get() as $player)
                                            <li class="mdl-list__item">
                                                <span class="mdl-list__item-primary-content">
                                                    <div
                                                        class="material-icons mdl-badge mdl-badge--overlap"
                                                        data-badge="0"
                                                        id="count_goals_{{ $player->id }}"
                                                    >sports_soccer</div>
                                                </span>
                                                <span class="mdl-list__item-primary-content">
                                                    {{ $player->name }}
                                                </span>
                                                <span class="mdl-list__item-secondary-action">
                                                    <button
                                                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary mdl-button--raised"
                                                        onclick="addGoalTeamGuest({{ $player->toJson() }})"
                                                    >
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </span>
                                            </li>
                                            <hr class="mdl-color--brown-500"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button
            class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--primary"
            style="position: fixed; display: block; right: 0; bottom: 0; margin-right: 40px; margin-bottom: 30px;z-index: 900;"
            id="confirm"
        >
            <i class="material-icons">done</i>
        </button>

        <dialog class="mdl-dialog">
            <div class="mdl-dialog__content">
                <p style="font-size: 16px"> <strong> {{ $game->teamHome->name }} </strong> </p>
                <div id="list_goals_home" style="list-style: none">

                </div>
                <p style="font-size: 16px"> <strong> {{ $game->teamGuest->name }} </strong> </p>
                <div id="list_goals_guest" style="list-style: none">
                </div>
            </div>
            <div class="mdl-dialog__actions" style="display: flex; justify-content: space-between">
                    <button
                        id="btnSubmit"
                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-color--green-500"
                    >
                        <i class="material-icons">check</i> Confirmar
                    </button>
                    <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect close"><i class="material-icons">close</i></button>
            </div>
        </dialog>

        <script>
            var goalsTeamHome = [];

            function addGoalTeamHome(player){
                goalsTeamHome.push(player);

                let count = document.querySelector(`#count_goals_${player.id}`);
                count.setAttribute('data-badge', parseInt(count.getAttribute('data-badge')) + 1)

                document.querySelector('#score_team_home').innerHTML = goalsTeamHome.length;
            }

            var goalsTeamGuest = [];

            function addGoalTeamGuest(player){
                goalsTeamGuest.push(player);

                let count = document.querySelector(`#count_goals_${player.id}`);
                count.setAttribute('data-badge', parseInt(count.getAttribute('data-badge')) + 1)

                document.querySelector('#score_team_guest').innerHTML = goalsTeamGuest.length;
            }

            var dialog = document.querySelector('dialog');
            var showDialogButton = document.querySelector('#confirm');

            showDialogButton.addEventListener('click', function() {
                let list_html_home = '';
                goalsTeamHome.map(player => list_html_home += `<li> ${player.name} </li><hr/>`)
                document.querySelector('#list_goals_home').innerHTML = list_html_home;

                let list_html_guest = '';
                goalsTeamGuest.map(player => list_html_guest += `<li> ${player.name} </li><hr/>`)
                document.querySelector('#list_goals_guest').innerHTML = list_html_guest;

                dialog.showModal();
            });

            dialog.querySelector('.close').addEventListener('click', function() {
                dialog.close();
            });

            var btnSubmit = document.querySelector('#btnSubmit');
            btnSubmit.onclick = () => {
                fetch( "{{ route('adm.official.calculate_score') }}", {
                    method: "POST",
                    headers: { "Content-Type": "application/json", 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    body: JSON.stringify({
                        goalsTeamHome,
                        goalsTeamGuest,
                        game: @json($game),
                    })
                })
                .then( data => data.json())
                .then((response) => {
                    if(response.status === 'success'){
                        window.location.replace(" {{ route('adm.official.competitionGames', ['competition' => $game->competition ]) }} ");
                    }
                });
            }
        </script>

@endsection
