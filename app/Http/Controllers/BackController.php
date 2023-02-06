<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackController extends Controller
{
    public function showHome()
    {
        $pageTitle = 'Pradinis';

        return view('pages.back.home-admin', compact('pageTitle'));
    }

    public function showOrders()
    {
        $pageTitle = 'Užsakymai';

        return view('pages.back.orders-admin', compact('pageTitle'));
    }

    public function showUsers()
    {
        $pageTitle = 'Vartotojai';
        return view('pages.back.users-admin', compact('pageTitle'));
    }

    public function showReviews()
    {
        return 'reviews page';
    }

    public function showCountries()
    {
        $pageTitle = 'Šalys';

        return view('pages.back.countries-admin', compact('pageTitle'));
    }

    public function showAddCountry()
    {
        $pageTitle = 'Pridėti šalį';

        return view('pages.back.add-country-admin', compact('pageTitle'));
    }

    public function showHotels()
    {
        $pageTitle = 'Viešbučiai';
        return view('pages.back.hotels-admin', compact('pageTitle'));
    }

    public function showAddHotel()
    {
        $pageTitle = 'Pridėti viešbutį';

        return view('pages.back.add-hotel-admin', compact('pageTitle'));
    }

    public function showTravels()
    {
        $pageTitle = 'Užsakymai';

        return view('pages.back.travels-admin', compact('pageTitle'));
    }
}
