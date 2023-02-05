<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackController extends Controller
{
    public function showHome()
    {
        return view('pages.back.home-admin');
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
        return 'countries page';
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
