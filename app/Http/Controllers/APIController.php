<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Review;
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

    public function filterOffers(Request $request)
    {
        if($request->s && $request->s !== '') {
            if($request->filter !== 'all') {
                $offers = Offer::where('countries.id', $request->filter)
                                ->join('destinations', 'destinations.id', 'offers.destination_id')
                                ->join('countries', 'countries.id', 'offers.country_id')
                                ->join('hotels', 'hotels.id', 'offers.hotel_id')
                                ->withCount(['orders as approved_orders_count' => function ($query) {
                                    $query->where('status', '1');
                                }]);
            } else {
                $offers = Offer::where('offers.id', '>', 0)
                                ->join('destinations', 'destinations.id', 'offers.destination_id')
                                ->join('countries', 'countries.id', 'offers.country_id')
                                ->join('hotels', 'hotels.id', 'offers.hotel_id')
                                ->withCount(['orders as approved_orders_count' => function ($query) {
                                    $query->where('status', '1');
                                }]);
            }

            $searchWords = explode(' ', $request->s);

            if(count($searchWords) === 1) {
                $offers = $offers->where(function($builder) use($searchWords) {
                                $builder->where('offers.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('destinations.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('destinations.desc', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('countries.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('countries.continent', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('hotels.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%');
                            });
            }

            if(count($searchWords) === 2) {
                $offers = $offers->where(function($builder) use($searchWords) {
                                $builder->where('offers.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                                        ->orWhere('offers.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                                        ->orWhere('offers.name', 'like', '%' . $searchWords[1] . '%')
                                        ->orWhere('offers.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('destinations.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                                        ->orWhere('destinations.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                                        ->orWhere('destinations.name', 'like', '%' . $searchWords[1] . '%')
                                        ->orWhere('destinations.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('destinations.desc', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                                        ->orWhere('destinations.desc', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                                        ->orWhere('destinations.desc', 'like', '%' . $searchWords[1] . '%')
                                        ->orWhere('destinations.desc', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('countries.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                                        ->orWhere('countries.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                                        ->orWhere('countries.name', 'like', '%' . $searchWords[1] . '%')
                                        ->orWhere('countries.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('countries.continent', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                                        ->orWhere('countries.continent', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                                        ->orWhere('countries.continent', 'like', '%' . $searchWords[1] . '%')
                                        ->orWhere('countries.continent', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('hotels.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                                        ->orWhere('hotels.name', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                                        ->orWhere('hotels.name', 'like', '%' . $searchWords[1] . '%')
                                        ->orWhere('hotels.name', 'like', '%' . $searchWords[0] . '%')
                                        ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
                                        ->orWhere('hotels.address', 'like', '%' . $searchWords[1] . '%' . $searchWords[0] . '%')
                                        ->orWhere('hotels.address', 'like', '%' . $searchWords[1] . '%')
                                        ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%');
                            });
            }
        } else {
            $offers = Offer::withCount(['orders as approved_orders_count' => function ($query) {
                                $query->where('status', '1');
                            }])->where('id', '>', 0);

        }

        if($request->s == '' && $request->filter !== 'all') {
            $offers = $offers->where('country_id', $request->filter);
        }

        $offers = match($request->sort ?? '') {
            'popularity_desc' => $offers->orderBy('approved_orders_count', 'DESC'),
            'price_desc' => $offers->orderBy('price', 'DESC'),
            'price_asc' => $offers->orderBy('price'),
            default => $offers,
        };
        
        $offers = $offers->get();

        foreach ($offers as $offer) {
            $offer->hotel = Hotel::find($offer->hotel);
            $offer->destination = Destination::find($offer->destination);
            $offer->country = Country::find($offer->country);
        }

        return $offers;
    }

    public function fetchReview(Review $review)
    {
        return $review;
    }
}
