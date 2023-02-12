<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $pageTitle = 'Nakvynės vietos';
        $hotels = Hotel::all();

        return view('pages.back.hotels.hotels', compact('pageTitle', 'hotels'));
    }

     public function create()
    {
        $pageTitle = 'Pridėti nakvynės vietą';
        $countries = Country::all();
        $destinations = Destination::all();

        return view('pages.back.hotels.add-hotel', compact('pageTitle', 'countries', 'destinations'));
    }

    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'destination_id' => ['required', Rule::in(Destination::all()->pluck('id'))],
            'name' => ['required'],
            'address' => ['required'],
            'people_limit' => ['required', 'regex:/^\d+?/'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000'],
        ],
            [
                'country_id.required' => 'Nepalikite tuščio laukelio',
                'country_id.in' => 'Nėra tokios šalies',
                'destination_id.required' => 'Nepalikite tuščio laukelio',
                'destination_id.in' => 'Nėra tokios vietovės',
                'name.required' => 'Nepalikite tuščio laukelio',
                'address.required' => 'Nepalikite tuščio laukelio',
                'people_limit.required' => 'Nepalikite tuščio laukelio',
                'image.image' => 'Failas turi būti nuotrauka',
                'image.mimes' => 'Failas neatitinka formato (jpeg, png, jpg, gif)',
                'image.max' => 'Failas per didelis',
            ]
        );

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['address'] = strip_tags($incomingFields['address']);

        if ($request->file('image')) {
            $image = $request->file('image');

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $name . '-' . uniqid() . '.jpg';

            $image = Image::make($image)->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 300)->encode('jpg');

            Storage::put("public/hotels/$fileName", $image);
            $incomingFields['image'] = "/storage/hotels/$fileName";
        }

        Hotel::create($incomingFields);

        return redirect()->back()->with('success', 'Nakvynės vieta sėkmingai sukurta');
    }

    public function edit(Hotel $hotel)
    {
        $pageTitle = 'Redaguoti nakvynės vietą';
        $countries = Country::all();

        return view('pages.back.hotels.edit-hotel', compact('pageTitle', 'countries', 'hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        if($request->delete_photo) {
            Storage::delete(str_replace('/storage/', 'public/' , $hotel->image));
            $hotel->image = null;
            $hotel->save();

            return redirect()->back()->with('success', 'Nuotrauka sėkmingai ištrinta');
        }

        $incomingFields = $request->validate([
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'destination_id' => ['required', Rule::in(Destination::all()->pluck('id'))],
            'name' => ['required'],
            'address' => ['required'],
            'people_limit' => ['required', 'regex:/^\d+?/'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000'],
        ],
            [
                'country_id.required' => 'Nepalikite tuščio laukelio',
                'country_id.in' => 'Nėra tokios šalies',
                'destination_id.required' => 'Nepalikite tuščio laukelio',
                'destination_id.in' => 'Nėra tokios vietovės',
                'name.required' => 'Nepalikite tuščio laukelio',
                'address.required' => 'Nepalikite tuščio laukelio',
                'people_limit.required' => 'Nepalikite tuščio laukelio',
                'image.image' => 'Failas turi būti nuotrauka',
                'image.mimes' => 'Failas neatitinka formato (jpeg, png, jpg, gif)',
                'image.max' => 'Failas per didelis',
            ]
        );

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['address'] = strip_tags($incomingFields['address']);

        if ($request->file('image')) {
            $image = $request->file('image');

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $name . '-' . uniqid() . '.jpg';

            $image = Image::make($image)->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 300)->encode('jpg');

            if($hotel->image && $incomingFields['image']) {
                Storage::delete(str_replace('/storage/', 'public/' , $hotel->image));
            }

            $incomingFields['image'] = "/storage/hotels/$fileName";

            Storage::put("public/destinations/$fileName", $image);
        } else {
            $incomingFields['image'] = $hotel->image;
        }

        $hotel->update($incomingFields);

        return redirect()->back()->with('success', 'Nakvynės vieta sėkmingai atnaujinta');
    }

    public function delete(Hotel $hotel)
    {
        Storage::delete(str_replace('/storage/', 'public/' , $hotel->image));

        $hotel->delete();

        return redirect()->back()->with('success', 'Nakvynės vieta sėkmingai ištrinta');
    }
}
