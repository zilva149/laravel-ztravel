<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
     public function index()
    {
        $pageTitle = 'Pasiūlymai';
        $offers = Offer::all();

        foreach($offers as $offer) {
            $start = Carbon::parse($offer->travel_start);
            $end = Carbon::parse($offer->travel_end);

            $duration = $start->diffInDays($end);
            $offer->duration = $duration;
        }

        return view('pages.back.offers.offers', compact('pageTitle', 'offers'));
    }

    public function create()
    {
        $pageTitle = 'Pridėti pasiūlymą';
        $countries = Country::all();
        $destinations = Destination::all();
        $hotels = Hotel::all();

        return view('pages.back.offers.add-offer', compact('pageTitle', 'countries', 'destinations', 'hotels'));
    }

    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required'],
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'destination_id' => ['required', Rule::in(Destination::all()->pluck('id'))],
            'hotel_id' => ['required', Rule::in(Hotel::all()->pluck('id'))],
            'travel_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'travel_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'price' => ['required', 'regex:/^-?(?:[0-9]*[.])?[0-9]+$/', 'gt:0'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Offer::create($incomingFields);

        return redirect()->back()->with('success', 'Pasiūlymas sėkmingai sukurtas');
    }

    public function edit(Offer $offer)
    {
        $pageTitle = 'Redaguoti pasiūlymą';
        $countries = Country::all();
        $destinations = Destination::all();
        $hotels = Hotel::all();

        return view('pages.back.offers.edit-offer', compact('pageTitle', 'offer', 'countries', 'destinations', 'hotels'));
    }

    public function update(Request $request, Offer $offer)
    {
        $incomingFields = $request->validate([
            'name' => ['required'],
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'destination_id' => ['required', Rule::in(Destination::all()->pluck('id'))],
            'hotel_id' => ['required', Rule::in(Hotel::all()->pluck('id'))],
            'travel_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'travel_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'price' => ['required', 'regex:/^-?(?:[0-9]*[.])?[0-9]+$/', 'gt:0'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        $offer->update($incomingFields);

        return redirect()->back()->with('success', 'Pasiūlymas sėkmingai atnaujintas');
    }

    public function delete(Offer $offer)
    {
        $offer->delete();

        return redirect()->back()->with('success', 'Pasiūlymas sėkmingai ištrintas');
    }
}
