<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Country;
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

        $pageTitle = 'Pradinis';

        return view('pages.front.home-customer', compact('pageTitle'));
    }

    public function showHome()
    {
        $pageTitle = 'Pradinis';

        return view('pages.front.home-customer', compact('pageTitle'));
    }

    public function showOffers(Request $request)
    {
        if($request->s && $request->s !== '') {
            $searchWords = explode(' ', $request->s);

            if(count($searchWords) === 1) {
                $offers = Offer::query()
                            ->join('destinations', 'destinations.id', 'offers.destination_id')
                            ->join('countries', 'countries.id', 'offers.country_id')
                            ->join('hotels', 'hotels.id', 'offers.hotel_id')
                            ->where('offers.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('destinations.desc', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('countries.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('countries.continent', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.name', 'like', '%' . $searchWords[0] . '%')
                            ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%')
                            ->get();
            }

            if(count($searchWords) === 2) {
                $offers = Offer::query()
                            ->join('destinations', 'destinations.id', 'offers.destination_id')
                            ->join('countries', 'countries.id', 'offers.country_id')
                            ->join('hotels', 'hotels.id', 'offers.hotel_id')
                            ->where('offers.name', 'like', '%' . $searchWords[0] . '%' . $searchWords[1] . '%')
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
                            ->orWhere('hotels.address', 'like', '%' . $searchWords[0] . '%')
                            ->get();
            }
        } else {
            $offers = Offer::where('id', '>', 0)->get();

            if($request->filter ?? '') {
                if($request->filter !== 'all') {
                    $offers = $offers->where('country_id', $request->filter);
                }
    
                $offers = match($request->sort ?? '') {
                    'popularity_desc' => $offers,
                    'price_desc' => $offers->sortByDesc('price'),
                    'price_asc' => $offers->sortBy('price'),
                    default => $offers,
                };
            }
        }
        
        $pageTitle = 'Pasiūlymai';
        $countries = Country::all();
        $continents = Country::select('continent')->distinct()->get();
        $sortOptions = Offer::SORT;

        return view('pages.front.offers.offers-customer', compact('pageTitle', 'request', 'offers', 'countries', 'continents', 'sortOptions'));
    }

    public function showSingleOffer(Offer $offer)
    {
        $pageTitle = 'Pasiūlymas';

        return view('pages.front.offers.single-offer-customer', compact('pageTitle', 'offer'));
    }

    public function showPayment(Request $request, Offer $offer)
    {
        $pageTitle = 'Apmokėjimas';

        $start = Carbon::parse($offer->travel_start);
        $end = Carbon::parse($offer->travel_end);

        $duration = $start->diffInDays($end);
        $offer->duration = $duration;

        return view('pages.front.offers.payment-customer', compact('pageTitle', 'offer'));
    }

    public function storePayment(Request $request, Offer $offer)
    {
        // if(!auth()->check()) {
        //     return redirect('login')->with('success', 'Norėdami užsisakyti, prašome prisijungti');
        // }

        $incomingFields = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'address' => ['required'],
            'credit_card' => ['required', 'regex:/^\d{4}\s*\d{4}\s*\d{4}\s*\d{4}\s*$/'],
            'mm_yy' => ['required', 'regex:/^(0[1-9]|1[0-2])[\/\\\s\-]\d{2}$/'],
            'cvc' => ['required', 'regex:/^\d{3}$/'],
        ]);
        $incomingFields['firstname'] = strip_tags($incomingFields['firstname']);
        $incomingFields['lastname'] = strip_tags($incomingFields['lastname']);
        $incomingFields['address'] = strip_tags($incomingFields['address']);

        $incomingFields['user_id'] = auth()->user()->id;
        $incomingFields['destination_id'] = $offer->destination->id;
        $incomingFields['hotel_id'] = $offer->hotel->id;
        $incomingFields['offer_id'] = $offer->id;

        Order::create($incomingFields);

        return redirect()->route('customer-payment-success', $offer->id);
    }

    public function successPayment(Offer $offer)
    {
        $pageTitle = 'Apmokėjimas';

        return view('pages.front.offers.payment-success-customer', compact('pageTitle', 'offer'));
    }
    
    public function showOrders()
    {
        $pageTitle = 'Užsakymai';

        $orders = Order::all()->where('user_id', auth()->user()->id)->sortByDesc('id');

        foreach($orders as $order) {
            $start = Carbon::parse($order->offer->travel_start);
            $end = Carbon::parse($order->offer->travel_end);

            $duration = $start->diffInDays($end);
            $order->duration = $duration;
        }

        $statusOptions = array_flip(Order::STATUS);

        return view('pages.front.orders.orders-customer', compact('pageTitle', 'orders', 'statusOptions'));
    }
}
