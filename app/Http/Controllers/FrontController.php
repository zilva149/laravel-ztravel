<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        if(auth()->check()) {
            if(auth()->user()->role == User::ROLES['Admin']) {
                return redirect()->route('admin-home');
            }

            if(auth()->user()->role == User::ROLES['Customer']) {
                return redirect()->route('customer-home');
            }
        }

        $pageTitle = 'Pradinis';

        return view('pages.front.home-customer', compact('pageTitle'));
    }

    public function showHome()
    {
        $pageTitle = 'Pradinis';

        return view('pages.front.home-customer', compact('pageTitle'));
    }

    public function showOffers(Request $request)
    {
        if($request->s && $request->s !== '') {
            $offers = Offer::query()
                        ->join('destinations', 'destinations.id', 'offers.destination_id')
                        ->join('countries', 'countries.id', 'offers.country_id')
                        ->join('hotels', 'hotels.id', 'offers.hotel_id')
                        ->where('offers.name', 'like', '%' . $request->s . '%')
                        ->orWhere('destinations.name', 'like', '%' . $request->s . '%')
                        ->orWhere('destinations.desc', 'like', '%' . $request->s . '%')
                        ->orWhere('countries.name', 'like', '%' . $request->s . '%')
                        ->orWhere('countries.continent', 'like', '%' . $request->s . '%')
                        ->orWhere('hotels.name', 'like', '%' . $request->s . '%')
                        ->orWhere('hotels.address', 'like', '%' . $request->s . '%')
                        ->get();
        } else {
            $offers = Offer::where('id', '>', 0)->get();

            if($request->filter ?? '') {
                if($request->filter !== 'all') {
                    $offers = $offers->where('country_id', $request->filter);
                }
    
                $offers = match($request->sort ?? '') {
                    'popularity_desc' => $offers,
                    'price_desc' => $offers->sortByDesc('price'),
                    'price_asc' => $offers->sortBy('price'),
                    default => $offers,
                };
            }
        }
        
        $pageTitle = 'Pasiūlymai';
        $countries = Country::all();
        $continents = Country::select('continent')->distinct()->get();
        $sortOptions = Offer::SORT;

        return view('pages.front.offers.destinations-customer', compact('pageTitle', 'request', 'offers', 'countries', 'continents', 'sortOptions'));
    }

    public function showSingleOffer(Destination $destination)
    {
        $pageTitle = 'Pasiūlymas';

        return view('pages.front.offers.single-destinations-customer', compact('pageTitle', 'destination'));
    }
    
    public function showOrders()
    {
        $pageTitle = 'Užsakymai';

        return 'Customer Orders';
    }
}
