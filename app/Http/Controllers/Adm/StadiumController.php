<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\Redirect;

class StadiumController extends Controller
{
    public function index()
    {
        $stadia = Stadium::orderBy('name')->get();
        foreach ($stadia as &$stadium) {
            $stadium->country;
        }

        return Inertia::render('Adm/Stadium', [
            'stadia' => $stadia,
        ]);
    }

    public function create()
    {
        return Inertia::render('Adm/Stadium/create', [
            'countrys' => Country::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
        ], [
            'name.required' => 'Nome obrigatório.',
            'country_id.required' => 'Selecione o país.',
        ]);

        Stadium::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);

        return Redirect::route('adm.stadium.index');
    }

    public function edit($id)
    {
        return Inertia::render('Adm/Stadium/create', [
            'stadium' => Stadium::findOrFail($id),
            'countrys' => Country::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
        ], [
            'name.required' => 'Nome obrigatório.',
            'country_id.required' => 'Selecione o país.',
        ]);

        if($id){
            Stadium::find($id)->update([
                'name' => $request->name,
                'country_id' => $request->country_id,
            ]);

            return Redirect::route('adm.stadium.index');
        }
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        try {
            Stadium::find($id)->delete();
        } catch(Exception $e){
            return $this->redirectErrorPage(
                $e->getCode() === '23000' ? "Para deletar o registro, atualize ou exclua suas dependencias." : $e->getMessage(),
                $e->getCode()
            );
        }

        return Redirect::route('adm.stadium.index');
    }
}
