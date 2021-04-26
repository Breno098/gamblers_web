<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\CountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return view('adm.country.index', [
            'countries' => Country::orderBy('name')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('adm.country.form');
    }

    public function store(CountryRequest $request)
    {
        Country::create($request->all());

        return redirect()->route('adm.country.index');
    }

    public function edit(Country $country)
    {
        return view('adm.country.form', [
            'country' => $country
        ]);
    }

    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->all());

        return redirect()->route('adm.country.index');
    }

    public function show($id)
    {
        return $this->index();
    }

    public function destroy(Country $country)
    {
        try {
            $country->delete();
            return redirect()->route('adm.country.index');
        } catch(\Exception $e){
            return redirect()->route('adm.error', [
                'error' => $e->getCode() === '23000' ? "País vinculado a outro registro." : $e->getMessage()
            ]);
        }
    }
}
