<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\PlayerRequest;
use App\Models\Country;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\Redirect;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::whereNotNull('country_id')->orderBy('name')->get();
        foreach ($players as &$player) {
            $player->country;
            $player->team;
        }

        return Inertia::render('Adm/Player', [
            'players' => $players,
        ]);
    }

    public function create()
    {
        return Inertia::render('Adm/Player/create', [
            'countrys' => Country::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
            'positions' => ['GO', 'ZAG', 'LT', 'VOL', 'MEI', 'ATA']
        ]);
    }

    public function store(PlayerRequest $request)
    {
        Player::create($request->all());
        return Redirect::route('adm.player.index');
    }

    public function edit($id)
    {
        return Inertia::render('Adm/Player/create', [
            'player' => Player::findOrFail($id),
            'countrys' => Country::orderBy('name')->get(),
            'teams' => Team::orderBy('name')->get(),
            'positions' => ['GO', 'ZAG', 'LT', 'VOL', 'MEI', 'ATA']
        ]);
    }

    public function update(PlayerRequest $request, $id)
    {
        if($id){
            Player::find($id)->update($request->all());
            return Redirect::route('adm.player.index');
        }
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        try {
            Player::find($id)->delete();
        } catch(Exception $e){
            return $this->redirectErrorPage(
                $e->getCode() === '23000' ? "Para deletar o registro, atualize ou exclua suas dependencias." : $e->getMessage(),
                $e->getCode()
            );
        }

        return Redirect::route('adm.player.index');
    }
}
