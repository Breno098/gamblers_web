<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\TeamRequest;
use App\Models\Competition;
use App\Models\Country;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        return view('adm.team.index', [
            'teams' => Team::where('type', 'team')->where('active', true)->orderBy('name')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('adm.team.form', [
            'countries' => Country::orderBy('name')->get(),
            'competitions' => Competition::where('active', true)->orderBy('name')->get()
        ]);
    }

    public function store(TeamRequest $request)
    {
        $data = $request->all();

        $competitions = [];
        if(isset($request->competitions)){
            foreach ($request->competitions as $key => $value) {
                if($value === 'on'){
                    $competitions[] = $key;
                }
            }
        }

        if($request->photo){
            $name_photo = now()->format('YmdHis') . $request->file('photo')->getClientOriginalName();

            if(!$request->file('photo')->storeAs('public/teams', $name_photo)){
                return redirect()->route('adm.error', [
                    'error' => "Erro ao fazer o upload da foto"
                ]);
            }

            $data['name_photo'] = $name_photo;
        }

        $data['type'] = 'team';

        $team = Team::create($data);

        $team->competitions()->sync($competitions);

        $country_id = $data['country_id'];
        $country = Country::find($country_id);
        $team->country()->associate($country);

        $team->players()->create([
            'name' => 'Gol Contra',
        ]);

        $team->save();

        return redirect()->route('adm.team.index');
    }

    public function edit(Team $team)
    {
        return view('adm.team.form', [
            'countries' =>  Country::orderBy('name')->get(),
            'competitions' => Competition::where('active', true)->orderBy('name')->get(),
            'team' => $team
        ]);
    }

    public function update(TeamRequest $request, Team $team)
    {
        $data = $request->all();

        $competitions = [];
        if(isset($request->competitions)){
            foreach ($request->competitions as $key => $value) {
                if($value === 'on'){
                    $competitions[] = $key;
                }
            }
        }

        if($request->photo){
            $name_photo = now()->format('YmdHis') . $request->file('photo')->getClientOriginalName();

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

        $country_id = $data['country_id'];
        $country = Country::find($country_id);
        $team->country()->associate($country);

        $team->save();

        return redirect()->route('adm.team.index');
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        try {
            $team = Team::find($id);
            $team->update([ 'active' => false ]);

            return redirect()->route('adm.team.index');
        } catch(\Exception $e){
            $team->update([ 'active' => true ]);

            return redirect()->route('adm.error', [
                'error' => $e->getCode() === '23000' ? "Time vinculado a outro registro." : $e->getMessage(),
            ]);
        }
    }

    public function byCompetition(Request $request)
    {
        if(!$request->competitionId){
            return response()->json(['teams' => []]);
        }

        $competition = Competition::find($request->competitionId);

        $teams = $competition->teams()->select('name', 'id')->where('active', true)->get();

        return response()->json(['teams' => $teams]);
    }
}
