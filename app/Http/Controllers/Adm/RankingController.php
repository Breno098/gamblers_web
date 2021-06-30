<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\CompetitionRequest;
use App\Models\Competition;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RankingController extends Controller
{
    public function index()
    {
        return view('adm.ranking.index', [
            'competitions' => Competition::where('active', 1)->orderBy('name')->paginate(10)
        ]);
    }

    public function competition(Competition $competition)
    {
        $scores = DB::table('scoreboards')
                    ->selectRaw(
                        'users.name             as user_name,
                        users.avatar            as user_avatar,
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
                    ->groupByRaw('users.id, users.name, users.avatar, competitions.id, competitions.name, competitions.season')
                    ->orderBy('total_score', 'desc')
                    ->paginate(10);

        return view('adm.ranking.competition', [
            'competition' => $competition,
            'scores' => $scores
        ]);
    }
}
