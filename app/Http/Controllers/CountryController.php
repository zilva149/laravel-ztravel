<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        if ($request->file('image')) {
            $image = $request->file('image');

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $name . '-' . uniqid() . '.jpg';

            $image = Image::make($image)->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 300)->encode('jpg');

            Storage::put("public/countries/$fileName", $image);
            $incomingFields['image'] = "/storage/countries/$fileName";
        }

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
        if($request->delete_photo) {
            Storage::delete(str_replace('/storage/', 'public/' , $country->image));
            $country->image = null;
            $country->save();

            return redirect()->back()->with('success', 'Nuotrauka sėkmingai ištrinta');
        }

        $incomingFields = $request->validate([
            'name' => ['required'],
            'continent' => ['required', Rule::in(Country::CONTINENTS)],
            'season_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'season_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        if ($request->file('image')) {
            $image = $request->file('image');

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $name . '-' . uniqid() . '.jpg';

            $image = Image::make($image)->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 300)->encode('jpg');

            if($country->image && $incomingFields['image']) {
                Storage::delete(str_replace('/storage/', 'public/' , $country->image));
            }

            $incomingFields['image'] = "/storage/countries/$fileName";

            Storage::put("public/countries/$fileName", $image);
        } else {
            $incomingFields['image'] = $country->image;
        }

        $country->update($incomingFields);

        return redirect()->back()->with('success', 'Šalis sėkmingai atnaujinta');
    }

    public function delete(Country $country)
    {
        $countryHotels = $country->hotels;

        foreach($countryHotels as $hotel) {
            Storage::delete(str_replace('/storage/', 'public/' , $hotel->image));
        }

        Storage::delete(str_replace('/storage/', 'public/' , $country->image));

        $country->delete();

        return redirect()->back()->with('success', 'Šalis sėkmingai ištrinta');
    }
}
