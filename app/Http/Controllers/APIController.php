<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function countryHotels(Country $country)
    {
        return $country->hotels;
    }
}
