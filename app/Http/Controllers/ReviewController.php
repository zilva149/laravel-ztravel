<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order) {
        return 'making a review';
    }

    public function update(Request $request, Review $review) {
        return 'updating a review';
    }
}
