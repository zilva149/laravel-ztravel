<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $pageTitle = 'Viešbučiai';
        $hotels = Hotel::all();

        return view('pages.back.hotels.hotels', compact('pageTitle', 'hotels'));
    }

     public function create()
    {
        $pageTitle = 'Pridėti viešbutį';
        $countries = Country::all();

        return view('pages.back.hotels.add-hotel', compact('pageTitle', 'countries'));
    }

    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'country' => ['required', Rule::in(Country::all()->pluck('name'))],
            'name' => ['required', 'unique:hotels'],
            'desc' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['desc'] = strip_tags($incomingFields['desc']);

        $incomingFields['country_id'] = DB::table('countries')->where('name', $incomingFields['country'])->value('id');

        if ($request->file('image')) {
            $image = $request->file('image');

            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $name . '-' . uniqid() . '.jpg';

            $image = Image::make($image)->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 300)->encode('jpg');

            Storage::put("public/hotels/$fileName", $image);
            $incomingFields['image'] = $fileName;
        }

        Hotel::create($incomingFields);

        return redirect()->back()->with('success', 'Viešbutis sėkmingai sukurtas');
    }

    public function edit(Hotel $hotel)
    {
        $pageTitle = 'Redaguoti viešbutį';
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
            'country' => ['required', Rule::in(Country::all()->pluck('name'))],
            'name' => ['required'],
            'desc' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2000'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['desc'] = strip_tags($incomingFields['desc']);

        $incomingFields['country_id'] = DB::table('countries')->where('name', $incomingFields['country'])->value('id');

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

            $incomingFields['image'] = $fileName;

            Storage::put("public/hotels/$fileName", $image);
        } else {
            $incomingFields['image'] = $hotel->image;
        }

       $hotel->update($incomingFields);

        return redirect()->back()->with('success', 'Viešbutis sėkmingai atnaujintas');
    }

    public function delete(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->back()->with('success', 'Viešbutis sėkmingai ištrinta');
    }
}
