<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return response()->json($countries);
    }

    public function show(Request $request, Country $country)
    {
        $country = Country::find($request->country);

        return response()->json($country);
    }

    public function store(Request $request)
    {
        $country       = new Country();
        $country->name = $request->name;
        $country->code = $request->code;
        $country->save();

        return response()->json(true);
    }

    public function update(Request $request, Country $country)
    {
        $country->name = $request->name;
        $country->code = $request->code;
        $country->update();

        return response()->json(true);
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json(true);
    }
}
