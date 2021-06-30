<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\CompetitionRequest;
use App\Models\Competition;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CompetitionController extends Controller
{
    public function index()
    {
        return view('adm.competition.index', [
            'competitions' => Competition::where('active', 1)->orderBy('name')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('adm.competition.form');
    }

    public function store(CompetitionRequest $request)
    {
        $data = $request->all();

        if($request->photo){
            $name_photo = Carbon::now()->format('YmdHis') . $request->file('photo')->getClientOriginalName();

            if(!$request->file('photo')->storeAs('public/competitions', $name_photo)){
                return redirect()->route('adm.error', [
                    'error' => "Erro ao fazer o upload da foto"
                ]);
            }

            $data['name_photo'] = $name_photo;
        }

        Competition::create($data);

        return redirect()->route('adm.competition.index');
    }

    public function edit(Competition $competition)
    {
        return view('adm.competition.form', [
            'competition' => $competition
        ]);
    }

    public function update(CompetitionRequest $request, Competition $competition)
    {
        $data = $request->all();

        if($request->photo){
            $name_photo = Carbon::now()->format('YmdHis') . $request->file('photo')->getClientOriginalName();

            if(Storage::exists('public/competitions/' . $competition->name_photo)){
                Storage::delete('public/competitions/' . $competition->name_photo);
            }

            if(!$request->file('photo')->storeAs('public/competitions/', $name_photo)){
                return redirect()->route('adm.error', [
                    'error' => "Erro ao fazer o upload da foto"
                ]);
            }

            $data['name_photo'] = $name_photo;
        }

        $competition->update($data);

        return redirect()->route('adm.competition.index');
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy(Competition $competition)
    {
        try {
            $competition->update([ 'active' => false ]);
            redirect()->route('adm.competition.index');
        } catch(\Exception $e){
            return redirect()->route('adm.error', [
                'error' => $e->getCode() === '23000' ? "Registro vinculado a outro registro." : $e->getMessage(),
            ]);
        }
    }
}
