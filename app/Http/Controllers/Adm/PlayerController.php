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
            'players' => Player::whereNotNull('country_id')->orderBy('name')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('adm.player.form', [
            'countries' => Country::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
            'positions' => ['GO', 'ZAG', 'LT', 'VOL', 'MEI', 'ATA']
        ]);
    }

    public function store(PlayerRequest $request)
    {
        Player::create($request->all());

        return redirect()->route('adm.player.index');
    }

    public function edit(Player $player)
    {
        return view('adm.player.form', [
            'player' => $player,
            'countries' => Country::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
            'positions' => ['GO', 'ZAG', 'LT', 'VOL', 'MEI', 'ATA']
        ]);
    }

    public function update(PlayerRequest $request, Player $player)
    {
        $player->update($request->all());

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
