<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'name' => ['required'],
            'continent' => ['required', Rule::in(Country::CONTINENTS)],
            'season_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'season_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Country::create($incomingFields);

        return redirect()->back()->with('success', 'Šalis sėkmingai sukurta');
    }

    public function edit()
    {
        $pageTitle = 'Redaguoti šalį';

        return view('pages.back.countries.edit-country', compact('pageTitle'));
    }

    public function update()
    {
        return 'edit country page';
    }

    public function delete()
    {
        return 'delete country page';
    }
}
