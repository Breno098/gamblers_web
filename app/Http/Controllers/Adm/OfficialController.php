<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Game;
use App\Models\Goal;
use App\Models\Scoreboard;
use App\Services\ScoreService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\Redirect;

class OfficialController extends Controller
{
    public function competitions()
    {
        return view('adm.official.index', [
            'competitions' => Competition::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function competitionGames(Competition $competition)
    {
        return view('adm.official.competition_games', [
            'games' => Game::where('competition_id', $competition->id)->where('status', 'open')->orderBy('date', 'desc')->get(),
        ]);
    }

    public function game(Game $game)
    {
        return view('adm.official.game', [
            'game' => $game,
        ]);
    }

    public function calculateScore(Request $request, ScoreService $scoreService)
    {
        $scoreService->saveRequest($request, 'official');

        $scoreService->calculate($request);

        return response()->json(['status' => 'success']);

    }
}
