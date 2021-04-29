<?php

namespace App\Http\Controllers\Gambler;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Game;
use App\Services\ScoreService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfficialController extends Controller
{
    public function competitions()
    {
        return view('gambler.official.index', [
            'competitions' => Auth::user()->competitions()->where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function competitionGames(Competition $competition)
    {
        $permissionCompetition = DB::select('select * from user_competition where user_id = ? and competition_id = ?', [
            Auth::user()->id,
            $competition->id
        ]);

        if(! $permissionCompetition){
            return redirect()->back();
        }

        return view('gambler.official.competition_games', [
            'games' => Game::where('competition_id', $competition->id)
                            ->where('status', 'open')
                            ->where('date', '>', now())
                            ->orderBy('date', 'desc')
                            ->get(),
        ]);
    }

    public function game(Game $game)
    {
        return view('gambler.official.game', [
            'game' => $game,
        ]);
    }

    public function storeBet(Request $request, ScoreService $scoreService)
    {
        if(! (Carbon::now() < Carbon::parse($request->game['date']))){
            return response()->json(['status' => 'expired time']);
        }

        $scoreService->saveRequest($request, 'bet', Auth::user()->id);

        return response()->json(['status' => 'success']);
    }
}
