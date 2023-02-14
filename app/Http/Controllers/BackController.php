<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;

class BackController extends Controller
{
    public function showHome()
    {
        $pageTitle = 'Pradinis';
        $orders = Order::all();

        foreach($orders as $order) {
            $start = Carbon::parse($order->offer->travel_start);
            $end = Carbon::parse($order->offer->travel_end);

            $duration = $start->diffInDays($end);
            $order->duration = $duration;
        }

        $statusOptions = array_flip(Order::STATUS);

        return view('pages.back.home-admin', compact('pageTitle', 'orders', 'statusOptions'));
    }

    public function showOrders()
    {
        $pageTitle = 'Užsakymai';

        $orders = Order::all();

        foreach($orders as $order) {
            $start = Carbon::parse($order->offer->travel_start);
            $end = Carbon::parse($order->offer->travel_end);

            $duration = $start->diffInDays($end);
            $order->duration = $duration;
        }

        $statusOptions = array_flip(Order::STATUS);

        return view('pages.back.orders.orders', compact('pageTitle', 'orders', 'statusOptions'));
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
