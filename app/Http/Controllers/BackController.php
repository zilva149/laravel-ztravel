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
}
