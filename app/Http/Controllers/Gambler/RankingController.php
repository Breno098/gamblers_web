<?php

namespace App\Http\Controllers\Gambler;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index()
    {
        return view('gambler.ranking.index', [
            'competitions' => Competition::where('active', 1)->orderBy('name')->paginate(10)
        ]);
    }

    public function competition(Competition $competition)
    {
        $scores = DB::table('scoreboards')
                    ->selectRaw(
                        'users.name             as user_name,
                        competitions.name       as competition_name,
                        competitions.season     as competition_season,
                        sum(scoreboards.score)  as total_score'
                    )
                    ->join('games', 'games.id', '=', 'scoreboards.game_id')
                    ->join('users', 'users.id', '=', 'scoreboards.user_id')
                    ->join('competitions', 'competitions.id', '=', 'games.competition_id')
                    ->where('scoreboards.type', 'bet')
                    ->where('games.status', 'finished')
                    ->where('competitions.active', true)
                    ->where('competitions.id', $competition->id)
                    ->groupByRaw('users.id, users.name, competitions.id, competitions.name, competitions.season')
                    ->paginate(10);

        return view('gambler.ranking.competition', [
            'competition' => $competition,
            'scores' => $scores
        ]);
    }
}
