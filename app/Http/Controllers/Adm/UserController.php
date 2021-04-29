<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Http\Request;
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
                    ->where('users.id', $user->id)
                    ->groupByRaw('users.id, users.name, competitions.id, competitions.name, competitions.season')
                    ->paginate(10);

        return view('adm.user.info', [
            'user' => $user,
            'scores' => $scores,
            'competitions' => Competition::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function updateCompetition(Request $request)
    {
        $result = DB::table('user_competition')
            ->where('user_id', $request->userId)
            ->where('competition_id', $request->competitionId)
            ->first();

        if($result){
            DB::table('user_competition')
                ->where('user_id', $request->userId)
                ->where('competition_id', $request->competitionId)
                ->delete();
        } else {
            DB::table('user_competition')->insert([
                'user_id' => $request->userId,
                'competition_id' => $request->competitionId
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function report(User $user, Competition $competition)
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
                    ->where('users.id', $user->id)
                    ->where('competitions.id', $competition->id)
                    ->get();

        return view('adm.user.report', [
            'user' => $user,
            'scores' => $scores,
            'competition' => $competition
        ]);
    }
}
