<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactsMessage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        if(auth()->check()) {
            if(auth()->user()->role == User::ROLES['Admin']) {
                return redirect()->route('admin-home');
            }
        }

        $pageTitle = 'Pradinis';

        $topDestinations = Destination::withCount(['orders as approved_orders_count' => function ($query) {
            $query->where('status', '1');
        }])->where('id', '>', 0)->orderBy('approved_orders_count', 'DESC')->get()->take(3);

        foreach($topDestinations as $destination) {
            $destination->min_price = Offer::where('destination_id', $destination->id)->min('price');
        }

        return view('pages.front.home-customer', compact('pageTitle', 'topDestinations'));
    }

    public function showOffers(Request $request)
    {
        $pageTitle = 'Pasiūlymai';
        $offers = Offer::withCount(['orders as approved_orders_count' => function ($query) {
            $query->where('status', '1');
        }])->where('id', '>', 0)->orderBy('approved_orders_count', 'DESC')->get();     
        $countries = Country::all();
        $continents = Country::select('continent')->distinct()->get();
        $sortOptions = Offer::SORT;

        foreach($offers as $offer) {
            $offer->avg_rating = $offer->reviews->avg('rating');
            $offer->count_rating = $offer->reviews->count();
        }

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

    public function showAboutUs()
    {
        $pageTitle = 'Apie mus';

        return view('pages.front.about-us', compact('pageTitle'));
    }

    public function showContacts()
    {
        $pageTitle = 'Kontaktai';

        return view('pages.front.contacts.contacts', compact('pageTitle'));
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'desc' => ['required'],
        ]);
 
        if ($validator->fails()) {
            $request->flash();
            return redirect('/contacts#contacts-form')
                        ->withErrors($validator);
        }

        $request->desc = strip_tags($request->desc);

        dispatch(new SendContactsMessage([
            'to' => 'ztravel@gmail.com',
            'email' => $request->email,
            'desc' => $request->desc,
        ]));

        return redirect('/contacts#contacts-form')->with('success', 'Žinutė sėkmingai išsiųsta!');
    }

    public function showDestinations(Request $request)
    {
        $pageTitle = 'Vietovės';
        $destinations = Destination::withCount(['orders as approved_orders_count' => function ($query) {
            $query->where('status', '1');
        }])->where('id', '>', 0)->orderBy('approved_orders_count', 'DESC')->get();     
        $countries = Country::all();
        $continents = Country::select('continent')->distinct()->get();

        foreach($destinations as $destination) {
            $destination->min_price = Offer::where('destination_id', $destination->id)->min('price');
        }

        return view('pages.front.destinations.destinations-customer', compact('pageTitle', 'destinations', 'countries', 'continents', 'request'));
    }
}
