@extends('gambler.layout')

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col demo-card-wide mdl-card">
            <div class="mdl-card__supporting-text">
                <div style="
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto;
                        padding: 15px;
                        width: 250px;
                        flex-direction: column
                    "
                >
                    <strong style="text-align: center;">Escolha seu avatar</strong>
                </div>

                @foreach ($avatars as $avatar)
                    <a

                        href="{{ route('user.update_avatar', ['avatar' => $avatar]) }}"
                        style="
                            background: rgba(0, 0 , 0, 0.05);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 50%;
                            margin: 25px auto 0;
                            padding: 15px;
                            width: 250px;
                            height: 250px;
                        "
                    >
                        <img
                            class="avatar"
                            src="{{ asset('storage/avatar/' . $avatar ) }}"
                            alt="avatar"
                            style="height: 100%; width: 200px; border-radius: 50%; padding: 10px 30px"
                        />
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
