<?php

namespace App\Http\Controllers\Gambler;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $scores = DB::table('scoreboards')
                    ->selectRaw(
                        'users.name             as user_name,
                        competitions.name       as competition_name,
                        competitions.id         as competition_id,
                        competitions.season     as competition_season,
                        sum(scoreboards.score)  as total_score'
                    )
                    ->join('games', 'games.id', '=', 'scoreboards.game_id')
                    ->join('users', 'users.id', '=', 'scoreboards.user_id')
                    ->join('competitions', 'competitions.id', '=', 'games.competition_id')
                    ->where('scoreboards.type', 'bet')
                    ->where('games.status', 'finished')
                    ->where('competitions.active', true)
                    ->where('users.id', Auth::user()->id)
                    ->groupByRaw('users.id, users.name, competitions.id, competitions.name, competitions.season')
                    ->paginate(10);

        return view('gambler.user.index', [
            'user' => Auth::user(),
            'scores' => $scores
        ]);
    }

    public function report(Competition $competition)
    {
        $scores = DB::table('scoreboards')
                    ->selectRaw(
                        'users.name             as user_name,
                        competitions.name       as competition_name,
                        competitions.season     as competition_season,
                        scoreboards.report      as report,
                        scoreboards.score       as score,
                        date_format(games.date, "%d/%m/%Y")  as date,
                        (select name from teams where teams.id = games.team_home_id)  as team_home_name,
                        (select name from teams where teams.id = games.team_guest_id) as team_guest_name'
                    )
                    ->join('games', 'games.id', '=', 'scoreboards.game_id')
                    ->join('users', 'users.id', '=', 'scoreboards.user_id')
                    ->join('competitions', 'competitions.id', '=', 'games.competition_id')
                    ->where('scoreboards.type', 'bet')
                    ->where('games.status', 'finished')
                    ->where('users.id', Auth::user()->id)
                    ->where('competitions.id', $competition->id)
                    ->get();

        return view('gambler.user.report', [
            'user' => Auth::user(),
            'scores' => $scores,
            'competition' => $competition
        ]);
    }

    public function avatar()
    {
        return view('gambler.user.avatar', [
            'avatars' => [
                'cristiano-ronaldo.png',
                'messi.png',
                'neymar.png',
                'lukaku.png',
                'sergio-ramos.png',
                'harry-kane.png',
                'mo-salah.png',
                'griezmann.png',
                'isco.png',
                'luis-suarez.png',
                'luka-modric.png',
                'mbappe.png',
                'paul-pogba.png',
                'ramadel-falcao.png',
                'toni-kroos.png'
            ]
        ]);
    }

    public function updateAvatar(string $avatar)
    {
        Auth::user()->update([
            'avatar' => $avatar
        ]);

        return redirect()->route('user.index');
    }
}
