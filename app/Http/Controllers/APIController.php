<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function countryDestinations(Country $country)
    {
        return $country->destinations;
    }

    public function destinationHotels(Destination $destination)
    {
        return $destination->hotels;
    }
}
