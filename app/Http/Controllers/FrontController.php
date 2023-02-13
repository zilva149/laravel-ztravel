<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;

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

    public function showOffers()
    {
        $pageTitle = 'Pasiūlymai';
        $countries = Country::all();
        $continents = Country::select('continent')->distinct()->get();
        $hotels = Hotel::all();
        $sortOptions = Hotel::SORT;

        return view('pages.front.offers.destinations-customer', compact('pageTitle', 'countries', 'hotels', 'continents', 'sortOptions'));
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
