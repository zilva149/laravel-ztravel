<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order) {
        $incomingFields = $request->validate([
            'rating' => ['required'],
            'desc' => ['nullable'],
        ]);

        $incomingFields['desc'] = strip_tags($incomingFields['desc']);
        $incomingFields['user_id'] = auth()->user()->id;
        $incomingFields['order_id'] = $order->id;

        $order->update(['isReviewed' => '1']);
        Review::create($incomingFields);

        return redirect("/orders#$order->id")->with('success', 'Ačiū už atsiliepimą!')->with('id', $order->id);
    }

    public function update(Request $request, Review $review) {
        $incomingFields = $request->validate([
            'rating' => ['required'],
            'desc' => ['nullable'],
        ]);

        $incomingFields['desc'] = strip_tags($incomingFields['desc']);

        $review->update($incomingFields);

        $id = $review->order->id;
        return redirect("/orders#$id")->with('success', 'Atsiliepimas sėkmingai atnaujintas!')->with('id', $id);
    }
}
