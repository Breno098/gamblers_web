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
        return view('adm.official.competitionGames', [
            'games' => Game::where('competition_id', $competition->id)->orderBy('date', 'desc')->get(),
        ]);
    }

    public function game(Request $request)
    {
        $game = Game::findorFail($request->id);
        $game->competition;
        $game->stadium->country;
        $game->teamHome->players;
        $game->teamHome->country;
        $game->teamGuest->players;
        $game->teamGuest->country;

        $game->addScoreboardOfficialAndGoals();

        return Inertia::render('Adm/Official/game', [
            'game' => $game,
        ]);
    }

    public function calculateScore(Request $request, ScoreService $scoreService)
    {
        $scoreService->saveRequest($request, 'official');

        $scoreService->calculate($request);

        return Redirect::route('adm.official.competition', [
            'competition_id' => $request->game['competition']['id']
        ]);
    }
}
