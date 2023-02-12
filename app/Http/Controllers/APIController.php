<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function countryDestinations(Country $country)
    {
        return $country->destinations;
    }
}
