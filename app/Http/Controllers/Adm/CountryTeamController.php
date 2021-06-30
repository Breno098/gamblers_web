<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\CountryTeamRequest;
use App\Models\Competition;
use App\Models\Country;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class CountryTeamController extends Controller
{
    public function index()
    {
        return view('adm.country_team.index', [
            'teams' => Team::where('type', 'country_team')->orderBy('name')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('adm.country_team.form', [
            'countries' => Country::orderBy('name')->get(),
            'competitions' => Competition::where('active', true)->orderBy('name')->get()
        ]);
    }

    public function store(CountryTeamRequest $request)
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

        $data['type'] = 'country_team';

        $country_team = Team::create($data);

        $country_team->competitions()->sync($competitions);

        $country_team->players()->create([
            'name' => 'Gol Contra',
        ]);

        $country_team->save();

        return redirect()->route('adm.country_team.index');
    }

    public function edit(Team $country_team)
    {
        return view('adm.country_team.form', [
            'countries' =>  Country::orderBy('name')->get(),
            'competitions' => Competition::where('active', true)->orderBy('name')->get(),
            'country_team' => $country_team
        ]);
    }

    public function update(CountryTeamRequest $request, Team $country_team)
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

            if(Storage::exists('public/teams/' . $country_team->name_photo)){
                Storage::delete('public/teams/' . $country_team->name_photo);
            }

            if(!$request->file('photo')->storeAs('public/teams/', $name_photo)){
                return redirect()->route('adm.error', [
                    'error' => "Erro ao fazer o upload da foto"
                ]);
            }

            $data['name_photo'] = $name_photo;
        }

        $country_team->update($data);
        $country_team->competitions()->sync($competitions);

        $country_team->save();

        return redirect()->route('adm.country_team.index');
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        try {
            $country_team = Team::find($id);
            $competitions = $country_team->competitions;
            $player = $country_team->players()->where('name', 'Gol Contra')->first();

            $country_team->competitions()->sync([]);
            $country_team->players()->where('name', 'Gol Contra')->delete();
            $country_team->delete();

            return redirect()->route('adm.country_team.index');
        } catch(\Exception $e){
            $country_team->competitions()->sync($competitions);
            $country_team->player()->create($player);

            return redirect()->route('adm.error', [
                'error' => $e->getCode() === '23000' ? "Time vinculado a outro registro." : $e->getMessage(),
            ]);
        }
    }
}
