<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\TeamRequest;
use App\Models\Competition;
use App\Models\Country;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        return view('adm.team.index', [
            'teams' => Team::orderBy('name')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('adm.team.form', [
            'countries' => Country::orderBy('name')->get(),
            'competitions' => Competition::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function store(TeamRequest $request)
    {
        $data = $request->all();

        $competitions = [];
        foreach ($request->competitions as $key => $value) {
            if($value === 'on'){
                $competitions[] = $key;
            }
        }

        if($request->photo){
            $name_photo = Carbon::now()->format('YmdHis') . $request->file('photo')->getClientOriginalName();

            if(!$request->file('photo')->storeAs('public/teams', $name_photo)){
                return redirect()->route('adm.error', [
                    'error' => "Erro ao fazer o upload da foto"
                ]);
            }

            $data['name_photo'] = $name_photo;
        }

        $team = Team::create($data);
        $team->competitions()->sync($competitions);

        Player::create([
            'name' => 'Gol Contra',
            'team_id' => $team->id,
        ]);

        return redirect()->route('adm.team.index');
    }

    public function edit(Team $team)
    {
        return view('adm.team.form', [
            'countries' =>  Country::orderBy('name')->get(),
            'competitions' => Competition::where('active', 1)->orderBy('name')->get(),
            'team' => $team
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $data = $request->all();

        $competitions = [];
        foreach ($request->competitions as $key => $value) {
            if($value === 'on'){
                $competitions[] = $key;
            }
        }

        if($request->photo){
            $name_photo = Carbon::now()->format('YmdHis') . $request->file('photo')->getClientOriginalName();

            if(Storage::exists('public/teams/' . $team->name_photo)){
                Storage::delete('public/teams/' . $team->name_photo);
            }

            if(!$request->file('photo')->storeAs('public/teams/', $name_photo)){
                return redirect()->route('adm.error', [
                    'error' => "Erro ao fazer o upload da foto"
                ]);
            }

            $data['name_photo'] = $name_photo;
        }

        $team->update($data);
        $team->competitions()->sync($competitions);

        return redirect()->route('adm.team.index');
    }

    public function updateWithImage(TeamRequest $request)
    {
        $name_photo = $request->file('photo') ? Carbon::now()->format('YmdHis') . $request->file('photo')->getClientOriginalName() : false;

        if($name_photo && !$request->file('photo')->storeAs('teams', $name_photo)){
            return $this->redirectErrorPage("Erro ao fazer o upload da foto");
        }

        if($request->id){
            $team = Team::find($request->id);

            if($name_photo && Storage::exists('public/teams/' . $team->name_photo)){
                Storage::delete('public/teams/' . $team->name_photo);
            }

            $team->update([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'name_photo' => $name_photo ?: $team->name_photo
            ]);

            $team->competitions()->sync($request->competitions);

            return redirect()->route('adm.team.index');
        }
    }



    public function show($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        try {
            $team = Team::find($id);
            $competitions = $team->competitions;
            $player = $team->players()->where('name', 'Gol Contra')->delete();

            $team->competitions()->sync([]);
            $team->delete();

            return Redirect::route('adm.team.index');
        } catch(\Exception $e){
            $team->competitions()->sync($competitions);

            return redirect()->route('adm.error', [
                'error' => $e->getCode() === '23000' ? "Time vinculado a outro registro." : $e->getMessage(),
                'error' => $e->getMessage()
            ]);
        }
    }
}
