<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
     public function index()
    {
        $pageTitle = 'Kelionės';
        $travels = Travel::all();

        return view('pages.back.travels.travels', compact('pageTitle', 'travels'));
    }
}
