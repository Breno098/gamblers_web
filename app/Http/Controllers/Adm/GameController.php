<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\GameRequest;
use App\Models\Competition;
use App\Models\Country;
use App\Models\Game;
use App\Models\Stadium;
use App\Models\Team;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('date')->get();
        foreach ($games as &$game) {
            $game->country;
            $game->competition;
            $game->stadium->country;
            $game->teamHome->country;
            $game->teamGuest->country;
            $game->goals;
            $game->scoreboard = $game->scoreboard()->where('type', 'official')->first();
        }

        return Inertia::render('Adm/Game', [
            'games' => $games,
        ]);
    }

    public function create()
    {
        return Inertia::render('Adm/Game/create', [
            'country' => Country::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
            'stadia' => Stadium::orderBy('name')->get(),
            'competitions' => Competition::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function store(GameRequest $request)
    {
        Game::create([
            'team_home_id' => $request->team_home_id,
            'team_guest_id' => $request->team_guest_id,
            'stadium_id' => $request->stadium_id,
            'competition_id' => $request->competition_id,
            'date' => $request->date,
            'time' => $request->time,
            'stage' => $request->stage,
            'status' => 'open'
        ]);

        return Redirect::route('adm.game.index');
    }

    public function edit($id)
    {
        return Inertia::render('Adm/Game/create', [
            'game' => Game::findOrFail($id),
            'country' => Country::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
            'stadia' => Stadium::orderBy('name')->get(),
            'competitions' => Competition::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function update(GameRequest $request, $id)
    {
        if($id){
            Game::find($id)->update([
                'team_home_id' => $request->team_home_id,
                'team_guest_id' => $request->team_guest_id,
                'stadium_id' => $request->stadium_id,
                'competition_id' => $request->competition_id,
                'date' => $request->date,
                'time' => $request->time,
                'stage' => $request->stage,
                'status' => 'open'
            ]);

            return Redirect::route('adm.game.index');
        }
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        try {
            Game::find($id)->delete();
        } catch(Exception $e){
            return $this->redirectErrorPage(
                $e->getCode() === '23000' ? "Para deletar o registro, atualize ou exclua suas dependencias." : $e->getMessage(),
                $e->getCode()
            );
        }

        return Redirect::route('adm.game.index');
    }
}
