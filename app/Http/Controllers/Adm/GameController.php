<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\GameRequest;
use App\Models\Competition;
use App\Models\Country;
use App\Models\Game;
use App\Models\Stadium;
use App\Models\Team;

class GameController extends Controller
{
    public function index()
    {
        return view('adm.game.index', [
            'games' => Game::orderBy('status', 'desc')->orderBy('date')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('adm.game.form', [
            'countries' => Country::orderBy('name')->get(),
            'stadia' => Stadium::orderBy('name')->get(),
            'competitions' => Competition::where('active', 1)->orderBy('name')->get(),
            'stages' => ['oitavas', 'quartas', 'semi', 'final', 'fase de grupo']
        ]);
    }

    public function store(GameRequest $request)
    {
        $data = $request->all();
        $data['date'] = $data['date'] . ' ' . $data['time'];
        $game = Game::create($data);

        $stadium_id = $data['stadium_id'];
        $stadium = Stadium::find($stadium_id);
        $game->stadium()->associate($stadium);

        $competition_id = $data['competition_id'];
        $competition = Competition::find($competition_id);
        $game->competition()->associate($competition);

        $team_home_id = $data['team_home_id'];
        $teamHome = Team::find($team_home_id);
        $game->teamHome()->associate($teamHome);

        $team_guest_id = $data['team_guest_id'];
        $teamGuest = Team::find($team_guest_id);
        $game->teamGuest()->associate($teamGuest);

        $game->save();

        return redirect()->route('adm.game.index');
    }

    public function edit(Game $game)
    {
        return view('adm.game.form', [
            'game' => $game,
            'countries' => Country::orderBy('name')->get(),
            'teams' => $game->competition->teams()->select('name', 'id')->where('active', true)->get(),
            'stadia' => Stadium::orderBy('name')->get(),
            'competitions' => Competition::where('active', 1)->orderBy('name')->get(),
            'stages' => ['oitavas', 'quartas', 'semi', 'final', 'fase de grupo']
        ]);
    }

    public function update(GameRequest $request, Game $game)
    {
        $data = $request->all();

        $data['date'] = $data['date'] . ' ' . $data['time'];
        
        $game->update($data);

        $stadium_id = $data['stadium_id'];
        $stadium = Stadium::find($stadium_id);
        $game->stadium()->associate($stadium);

        $competition_id = $data['competition_id'];
        $competition = Competition::find($competition_id);
        $game->competition()->associate($competition);

        $team_home_id = $data['team_home_id'];
        $teamHome = Team::find($team_home_id);
        $game->teamHome()->associate($teamHome);

        $team_guest_id = $data['team_guest_id'];
        $teamGuest = Team::find($team_guest_id);
        $game->teamGuest()->associate($teamGuest);

        $game->save();

        return redirect()->route('adm.game.index');
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy(Game $game)
    {
        try {
            $game->delete();
            return redirect()->route('adm.game.index');
        } catch(\Exception $e){
            return redirect()->route('adm.error', [
                'error' => $e->getCode() === '23000' ? "Para deletar o registro, atualize ou exclua suas dependencias." : $e->getMessage(),
            ]);
        }
    }
}
