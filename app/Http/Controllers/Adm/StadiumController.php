<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\StadiumRequest;
use App\Models\Country;
use App\Models\Stadium;

class StadiumController extends Controller
{
    public function index()
    {
        return view('adm.stadium.index', [
            'stadia' => Stadium::orderBy('name')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('adm.stadium.form', [
            'countries' => Country::orderBy('name')->get(),
        ]);
    }

    public function store(StadiumRequest $request)
    {
        $data = $request->all();

        $stadium = Stadium::create($data);

        $country_id = $data['country_id'];
        $country = Country::find($country_id);
        $stadium->country()->associate($country);

        $stadium->save();

        return redirect()->route('adm.stadium.index');
    }

    public function edit(Stadium $stadium)
    {
        return view('adm.stadium.form', [
            'stadium' => $stadium,
            'countries' => Country::orderBy('name')->get(),
        ]);
    }

    public function update(StadiumRequest $request, Stadium $stadium)
    {
        $data = $request->all();

        $stadium->update($data);

        $country_id = $data['country_id'];
        $country = Country::find($country_id);
        $stadium->country()->associate($country);

        $stadium->save();

        return redirect()->route('adm.stadium.index');
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy(Stadium $stadium)
    {
        try {
            $stadium->delete();
            return redirect()->route('adm.player.index');
        } catch(\Exception $e){
            return redirect()->route('adm.error', [
                'error' =>  $e->getCode() === '23000' ? "Para deletar o registro, atualize ou exclua suas dependencias." : $e->getMessage(),
            ]);
        }
    }
}
