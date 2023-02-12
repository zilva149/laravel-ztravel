<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Šalys';
        $countries = Country::all();

        return view('pages.back.countries.countries', compact('pageTitle', 'countries'));
    }

    public function create()
    {
        $pageTitle = 'Pridėti šalį';
        $continents = Country::CONTINENTS;

        return view('pages.back.countries.add-country', compact('pageTitle', 'continents'));
    }

    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'unique:countries'],
            'continent' => ['required', Rule::in(Country::CONTINENTS)],
            'season_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'season_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Country::create($incomingFields);

        return redirect()->back()->with('success', 'Šalis sėkmingai sukurta');
    }

    public function edit(Country $country)
    {
        $pageTitle = 'Redaguoti šalį';
        $continents = Country::CONTINENTS;

        return view('pages.back.countries.edit-country', compact('pageTitle', 'continents', 'country'));
    }

    public function update(Request $request, Country $country)
    {
        $incomingFields = $request->validate([
            'name' => ['required'],
            'continent' => ['required', Rule::in(Country::CONTINENTS)],
            'season_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'season_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        $country->update($incomingFields);

        return redirect()->back()->with('success', 'Šalis sėkmingai atnaujinta');
    }

    public function delete(Country $country)
    {
        foreach($country->destinations as $destination) {
            Storage::delete(str_replace('/storage/', 'public/' , $destination->image));
            foreach($destination->hotels as $hotel) {
                Storage::delete(str_replace('/storage/', 'public/' , $hotel->image));
            }
        }

        $country->delete();

        return redirect()->back()->with('success', 'Šalis sėkmingai ištrinta');
    }
}
