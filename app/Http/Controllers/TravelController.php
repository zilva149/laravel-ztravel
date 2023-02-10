<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Travel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class TravelController extends Controller
{
     public function index()
    {
        $pageTitle = 'Kelionės';
        $travels = Travel::all();

        foreach($travels as $travel) {
            $start = Carbon::parse($travel->travel_start);
            $end = Carbon::parse($travel->travel_end);

            $duration = $start->diffInDays($end);
            $travel->duration = $duration;
        }

        return view('pages.back.travels.travels', compact('pageTitle', 'travels'));
    }

    public function create()
    {
        $pageTitle = 'Pridėti kelionę';
        $countries = Country::all();
        $hotels = Hotel::all();

        return view('pages.back.travels.add-travel', compact('pageTitle', 'countries', 'hotels'));
    }

    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'unique:travel'],
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'hotel_id' => ['required', Rule::in(Hotel::all()->pluck('id'))],
            'travel_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'travel_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'price' => ['required', 'regex:/^-?(?:[0-9]*[.])?[0-9]+$/', 'gt:0'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        Travel::create($incomingFields);

        return redirect()->back()->with('success', 'Kelionė sėkmingai sukurta');
    }

    public function edit(Travel $travel)
    {
        $pageTitle = 'Redaguoti viešbutį';
        $countries = Country::all();
        $hotels = Hotel::all();

        return view('pages.back.travels.edit-travel', compact('pageTitle', 'travel', 'countries', 'hotels'));
    }

    public function update(Request $request, Travel $travel)
    {
        $incomingFields = $request->validate([
            'name' => ['required'],
            'country_id' => ['required', Rule::in(Country::all()->pluck('id'))],
            'hotel_id' => ['required', Rule::in(Hotel::all()->pluck('id'))],
            'travel_start' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'travel_end' => ['required', 'regex:/^\d{4}[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'price' => ['required', 'regex:/^-?(?:[0-9]*[.])?[0-9]+$/', 'gt:0'],
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);

        $travel->update($incomingFields);

        return redirect()->back()->with('success', 'Kelionė sėkmingai redaguota');
    }

    public function delete(Travel $travel)
    {
        $travel->delete();

        return redirect()->back()->with('success', 'Kelionė sėkmingai ištrinta');
    }
}
