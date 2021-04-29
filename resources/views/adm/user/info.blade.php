@extends('adm.layout')

@section('content')
    <div class="mdl-grid">

        <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card mdl-shadow--16dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text" style="display: flex; align-items: center">
                    <span class="material-icons">
                        account_circle
                    </span>
                    &nbsp; <strong> {{ $user->name }} </strong>
                </h1>
            </div>

            <div class="mdl-card__supporting-text">
                <ul class="mdl-list">
                    @foreach ($competitions as $competition)
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                {{ $competition->name }} | {{ $competition->season }}
                            </span>
                            <span class="mdl-list__item-secondary-action">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="competitions-{{ $competition->id }}">
                                <input
                                    type="checkbox"
                                    name="competitions[{{ $competition->id }}]"
                                    id="competitions-{{ $competition->id }}"
                                    class="mdl-switch__input"
                                    @foreach ($competition->users as $user_comp)
                                        {{ $user->id === $user_comp->id ? 'checked' : null }}
                                    @endforeach
                                    onchange="updateCompetition({{ $user->id }}, {{ $competition->id }} )"
                                />
                                </label>
                            </span>
                        </li>
                        <hr/>
                    @endforeach
                </ul>
            </div>
        </div>

        <dialog class="mdl-dialog">
            <div class="mdl-dialog__content">
                <div>
                    <p style="font-size: 16px"> <strong> Alterado </strong> </p>
                </div>
            </div>
        </dialog>

        <script>
            var dialog = document.querySelector('dialog');

            function updateCompetition(userId, competitionId){
                fetch( "{{ route('adm.user.update_competition') }}", {
                    method: "POST",
                    headers: { "Content-Type": "application/json", 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    body: JSON.stringify({
                        userId,
                        competitionId,
                    })
                })
                .then( data => data.json())
                .then((response) => {
                    if(response.status === 'success'){
                        dialog.showModal();
                        setTimeout(() => dialog.close(), 1000)
                    }
                });
            }
        </script>

        @foreach ($scores as $score)
            <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card mdl-shadow--16dp">
                <div class="mdl-card__title">
                    <h1 class="mdl-card__title-text" style="display: flex; align-items: center">
                        <span class="material-icons">
                            analytics
                        </span>
                        &nbsp; <strong> Pontuações </strong>
                    </h1>
                </div>

                <div class="mdl-card__supporting-text">
                    <ul class="mdl-list">
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <span class="material-icons">
                                    emoji_events
                                </span>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ $score->competition_name }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <strong> Temporada: </strong>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ $score->competition_season }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                        <li class="mdl-list__item mdl-list__item--one-line">
                            <span class="mdl-list__item-secondary-content">
                                <strong> Pontuação total: </strong>
                            </span>
                            <span class="mdl-list__item-text-body">
                                &nbsp; <strong> {{ number_format($score->total_score, 2, '.', '') }} </strong>
                            </span>
                        </li>
                        <hr class="mdl-color--accent" />
                    </ul>
                </div>
                <div class="mdl-card__actions ">
                    <a
                        class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary"
                        href="{{ route('adm.user.report', [ 'user' => $user, 'competition' => $score->competition_id ]) }}"
                        style="width: 100%; height: 40px; min-width: initial;"
                    >
                        <i class="material-icons">info</i>
                        <span class="mdc-button__label">Ver mais infomações</span>
                    </a>
                </div>
            </div>
        @endforeach


        <div class="mdl-card__actions" style="width: 100%; justify-content: flex-end; display: flex">
            <div>
            <a
                class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $scores->previousPageUrl() ? 'mdl-button--primary' : '' }}"
                {{ $scores->previousPageUrl() ?? 'disabled' }}
                href="{{ $scores->previousPageUrl() ?: '#' }}"
            >
                <span class="mdc-button__label">Anterior</span>
            </a>
            <a
                class="mdl-button mdl-js-button mdl-js-ripple-effect {{ $scores->nextPageUrl() ? 'mdl-button--primary' : '' }}"
                {{ $scores->nextPageUrl() ?? 'disabled' }}
                href="{{ $scores->nextPageUrl() ?: '#' }}"
            >
                <span class="mdc-button__label">Próximo</span>
            </a>
            </div>
        </div>
    </div>
@endsection
