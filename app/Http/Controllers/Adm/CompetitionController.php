<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\CompetitionRequest;
use App\Models\Competition;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CompetitionController extends Controller
{
    public function index()
    {
        return Inertia::render('Adm/Competition', [
            'competitions' => Competition::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Adm/Competition/create');
    }

    public function store(CompetitionRequest $request)
    {
        $name_photo = $request->file('photo') ? Carbon::now()->format('YmdHis') . $request->file('photo')->getClientOriginalName() : false;

        if($name_photo && !$request->file('photo')->storeAs('competitions', $name_photo)){
            return $this->redirectErrorPage("Erro ao fazer o upload da foto");
        }

        Competition::create([
            'name' => $request->name,
            'active' => 1,
            'name_photo' => $name_photo,
            'season' => $request->season,
        ]);

        return Redirect::route('adm.competition.index');
    }

    public function edit($id)
    {
        return Inertia::render('Adm/Competition/create', [
            'competition' => Competition::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
    }

    public function updateWithImage(CompetitionRequest $request)
    {
        $name_photo = $request->file('photo') ? Carbon::now()->format('YmdHis') . $request->file('photo')->getClientOriginalName() : false;

        if($name_photo && !$request->file('photo')->storeAs('competitions', $name_photo)){
            return $this->redirectErrorPage("Erro ao fazer o upload da foto");
        }

        if($request->id){
            $competition = Competition::find($request->id);

            if($name_photo && Storage::exists('competitions/' . $competition->name_photo)){
                Storage::delete('competitions/' . $competition->name_photo);
            }

            $competition->update([
                'name' => $request->name,
                'name_photo' => $name_photo ?: $competition->name_photo,
                'season' => $request->season,
            ]);

            return Redirect::route('adm.competition.index');
        }
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        Competition::find($id)->update([ 'active' => 0 ]);
        return Redirect::route('adm.competition.index');
    }
}
