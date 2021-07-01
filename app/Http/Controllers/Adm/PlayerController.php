<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\PlayerRequest;
use App\Models\Country;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
    public function index()
    {
        return view('adm.player.index', [
            'players' => Player::where("name", '!=', "Gol Contra")->orderBy('name')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('adm.player.form', [
            'countries' => Country::orderBy('name')->get(),
            'teams' => Team::where('type','team')->orderBy('name')->get(),
            'country_teams' => Team::where('type','country_team')->orderBy('name')->get(),
            'positions' => ['GO', 'ZAG', 'LT', 'VOL', 'MEI', 'ATA']
        ]);
    }

    public function store(PlayerRequest $request)
    {
        $data = $request->all();

        $player = Player::create($data);

        $syncs = []; 
        
        $team_id = $data['team_id'];
        $team = Team::find($team_id);
        
        $syncs[] =  $team->id;
        
        if($country_team_id = $data['country_team_id']){
             $country_team = Team::find($country_team_id);
             $syncs[] = $country_team->id;
        }
        
        $player->teams()->sync($syncs);

        $country_id = $data['country_id'];
        $country = Country::find($country_id);
        $player->country()->associate($country);

        $player->save();

        return redirect()->route('adm.player.index');
    }

    public function edit(Player $player)
    {
        return view('adm.player.form', [
            'player' => $player,
            'countries' => Country::orderBy('name')->get(),
            'teams' => Team::where('type','team')->orderBy('name')->get(),
            'country_teams' => Team::where('type','country_team')->orderBy('name')->get(),
            'positions' => ['GO', 'ZAG', 'LT', 'VOL', 'MEI', 'ATA']
        ]);
    }

    public function update(PlayerRequest $request, Player $player)
    {
        $data = $request->all();

        $player->update($data);

        $syncs = []; 
        
        $team_id = $data['team_id'];
        $team = Team::find($team_id);
        
        $syncs[] =  $team->id;
        
        if($country_team_id = $data['country_team_id']){
             $country_team = Team::find($country_team_id);
             $syncs[] = $country_team->id;
        }
        
        $player->teams()->sync($syncs);

        $country_id = $data['country_id'];
        $country = Country::find($country_id);
        $player->country()->associate($country);

        $player->save();

        return redirect()->route('adm.player.index');
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy(Player $player)
    {
        try {
            $player->delete();
            return redirect()->route('adm.player.index');
        } catch(\Exception $e){
            return redirect()->route('adm.error', [
                'error' =>  $e->getCode() === '23000' ? "Para deletar o registro, atualize ou exclua suas dependencias." : $e->getMessage(),
            ]);
        }
    }
}
