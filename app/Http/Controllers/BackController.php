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
        return 'orders page';
    }

    public function showClients()
    {
        return 'clients page';
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

    public function showHotels()
    {
        return 'hotels page';
    }

    public function showTravels()
    {
        return 'travels page';
    }
}
