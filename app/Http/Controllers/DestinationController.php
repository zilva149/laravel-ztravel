<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $pageTitle = 'Vietovės';
        $hotels = Destination::all();

        return view('pages.back.destinations.destinations', compact('pageTitle', 'destinations'));
    }

     public function create()
    {
        $pageTitle = 'Pridėti vietovę';
        $countries = Country::all();

        return view('pages.back.destinations.add-destination', compact('pageTitle', 'countries'));
    }

    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'name' => ['required', 'unique:destinations'],
            'desc' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['desc'] = strip_tags($incomingFields['desc']);

        if ($request->file('image')) {
            $image = $request->file('image');

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $name . '-' . uniqid() . '.jpg';

            $image = Image::make($image)->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 300)->encode('jpg');

            Storage::put("public/destinations/$fileName", $image);
            $incomingFields['image'] = "/storage/destinations/$fileName";
        }

        Destination::create($incomingFields);

        return redirect()->back()->with('success', 'Vietovė sėkmingai sukurta');
    }

    public function edit(Destination $destination)
    {
        $pageTitle = 'Redaguoti vietovę';
        $countries = Country::all();

        return view('pages.back.destinations.edit-destination', compact('pageTitle', 'countries', 'destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        if($request->delete_photo) {
            Storage::delete(str_replace('/storage/', 'public/' , $destination->image));
            $destination->image = null;
            $destination->save();

            return redirect()->back()->with('success', 'Nuotrauka sėkmingai ištrinta');
        }

        $incomingFields = $request->validate([
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'name' => ['required'],
            'desc' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['desc'] = strip_tags($incomingFields['desc']);

        if ($request->file('image')) {
            $image = $request->file('image');

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $name . '-' . uniqid() . '.jpg';

            $image = Image::make($image)->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 300)->encode('jpg');

            if($destination->image && $incomingFields['image']) {
                Storage::delete(str_replace('/storage/', 'public/' , $destination->image));
            }

            $incomingFields['image'] = "/storage/destinations/$fileName";

            Storage::put("public/destinations/$fileName", $image);
        } else {
            $incomingFields['image'] = $destination->image;
        }

        $destination->update($incomingFields);

        return redirect()->back()->with('success', 'Vietovė sėkmingai atnaujinta');
    }

    public function delete(Destination $destination)
    {
        Storage::delete(str_replace('/storage/', 'public/' , $destination->image));

        $destination->delete();

        return redirect()->back()->with('success', 'Vietovė sėkmingai ištrinta');
    }
}
