<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        Country::create($request->all());
        return redirect()->route('countries.index');
    }

    public function edit(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->fill($request->all());
        $country->save();
        return redirect()->route('countries.index');
    }

    public function delete($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect()->route('countries.index');
    }
}
