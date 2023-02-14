<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class BackController extends Controller
{
    public function showHome()
    {
        $pageTitle = 'Pradinis';

        $users = User::all()->where('role', '!=', User::ROLES['Admin']);

        foreach($users as &$user) {
            $userOrders = $user->orders;

            $sales = 0;
            foreach($userOrders as $order) {
                $sales += $order->offer->price;
            }

            $user->sales = $sales;
        }

        $users = $users->sortByDesc('sales')->take(7);
        
        $orders = Order::all()->sortBy('status')->take(5);

        foreach($orders as $order) {
            $start = Carbon::parse($order->offer->travel_start);
            $end = Carbon::parse($order->offer->travel_end);

            $duration = $start->diffInDays($end);
            $order->duration = $duration;
        }

        $statusOptions = array_flip(Order::STATUS);

        return view('pages.back.home-admin', compact('pageTitle', 'users', 'orders', 'statusOptions'));
    }

    public function showOrders()
    {
        $pageTitle = 'Užsakymai';

        $orders = Order::all()->sortBy('status');

        foreach($orders as $order) {
            $start = Carbon::parse($order->offer->travel_start);
            $end = Carbon::parse($order->offer->travel_end);

            $duration = $start->diffInDays($end);
            $order->duration = $duration;
        }

        $statusOptions = array_flip(Order::STATUS);

        return view('pages.back.orders.orders', compact('pageTitle', 'orders', 'statusOptions'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $order->update(['status' => (string) Order::STATUS['Patvirtinta']]);

        return redirect($request->fullUrl() . "#$order->id")->with('success', 'Užsakymas sėkmingai patvirtintas')->with('id', $order->id);
    }

    public function showUsers()
    {
        $pageTitle = 'Vartotojai';
        return view('pages.back.users.users-admin', compact('pageTitle'));
    }

    public function showReviews()
    {
        return 'reviews page';
    }
}
