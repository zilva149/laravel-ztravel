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
            $searchWords = explode(' ', $request->s);

            if(count($searchWords) === 1) {
                $offers = Offer::query()
                            ->join('destinations', 'destinations.id', 'offers.destination_id')
                            ->join('countries', 'countries.id', 'offers.country_id')
                            ->join('hotels', 'hotels.id', 'offers.hotel_id')
                            ->where('offers.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.desc', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('countries.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('countries.continent', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%')
                            ->get();
            }

            if(count($searchWords) === 2) {
                $offers = Offer::query()
                            ->join('destinations', 'destinations.id', 'offers.destination_id')
                            ->join('countries', 'countries.id', 'offers.country_id')
                            ->join('hotels', 'hotels.id', 'offers.hotel_id')
                            ->where('offers.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                            ->orWhere('offers.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                            ->orWhere('offers.name', 'like', '%' . $searchWords[1] . '%')
                            ->orWhere('offers.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                            ->orWhere('destinations.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.name', 'like', '%' . $searchWords[1] . '%')
                            ->orWhere('destinations.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.desc', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                            ->orWhere('destinations.desc', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.desc', 'like', '%' . $searchWords[1] . '%')
                            ->orWhere('destinations.desc', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('countries.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                            ->orWhere('countries.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                            ->orWhere('countries.name', 'like', '%' . $searchWords[1] . '%')
                            ->orWhere('countries.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('countries.continent', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                            ->orWhere('countries.continent', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                            ->orWhere('countries.continent', 'like', '%' . $searchWords[1] . '%')
                            ->orWhere('countries.continent', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                            ->orWhere('hotels.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.name', 'like', '%' . $searchWords[1] . '%')
                            ->orWhere('hotels.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                            ->orWhere('hotels.address', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.address', 'like', '%' . $searchWords[1] . '%')
                            ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%')
                            ->get();
            }
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

        return view('pages.front.offers.offers-customer', compact('pageTitle', 'request', 'offers', 'countries', 'continents', 'sortOptions'));
    }

    public function showSingleOffer(Offer $offer)
    {
        $pageTitle = 'Pasiūlymas';

        return view('pages.front.offers.single-offer-customer', compact('pageTitle', 'offer'));
    }

    public function storeOrder(Request $request, Offer $offer)
    {
        if(!auth()->check()) {
            return redirect('login')->with('success', 'Norėdami užsisakyti, prašome prisijungti');
        }

        return redirect($request->fullUrl() . '#order')->with('success', 'Užsakymas atliktas');
    }
    
    public function showOrders()
    {
        $pageTitle = 'Užsakymai';

        return 'Customer Orders';
    }
}
