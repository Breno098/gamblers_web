<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\PlayerRequest;
use App\Models\Country;
use App\Models\Player;
use App\Models\Scoreboard;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('adm.user.index', [
            'users' => User::orderBy('name')->paginate(10),
        ]);
    }

    public function info(User $user)
    {
        $userScoreBoards = DB::select("
            select
                user.name           as user_name,
                competition.name    as competition_name,
                competition.season  as competition_season,
                sum(score.score)    as total_score
            from gamblers_api.scoreboards score
            join gamblers_api.games game
                on score.game_id = game.id
            join gamblers_api.users user
                on user.id = score.user_id
            join gamblers_api.competitions competition
                on game.competition_id = competition.id
            where score.type = 'bet'
                and user.id = {$user->id}
                and game.status = 'finished'
            group by user.id, user.name, competition.id, competition.name, competition.season
        ");

        return view('adm.user.info', [
            'user' => $user,
            'userScoreBoards' => $userScoreBoards
        ]);
    }
}
