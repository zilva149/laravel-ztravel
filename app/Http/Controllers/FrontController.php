<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return view('pages.front.home-customer');
    }

    public function showHome()
    {
        return view('pages.front.home-customer');
    }
    
    public function showOrders()
    {
        return 'Customer Orders';
    }
}
