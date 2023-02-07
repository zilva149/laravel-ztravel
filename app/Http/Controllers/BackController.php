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

        return view('pages.back.orders.orders', compact('pageTitle'));
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

    public function showHotels()
    {
        $pageTitle = 'Viešbučiai';
        return view('pages.back.hotels.hotels', compact('pageTitle'));
    }

    public function showAddHotel()
    {
        $pageTitle = 'Pridėti viešbutį';

        return view('pages.back.hotels.add-hotel', compact('pageTitle'));
    }

    public function showTravels()
    {
        $pageTitle = 'Užsakymai';

        return view('pages.back.travels.travels', compact('pageTitle'));
    }
}
