<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::middleware('roles:Customer')->group(function() {
    Route::get('/home', [FrontController::class, 'customerHome'])->name('customer-home');
});

Route::middleware('roles:Admin|Manager')->prefix('/admin')->group(function() {
    Route::get('/home', [BackController::class, 'showHome'])->name('admin-home');
    Route::get('/orders', [BackController::class, 'showOrders'])->name('admin-orders');
    Route::get('/clients', [BackController::class, 'showClients'])->name('admin-clients');
    Route::get('/reviews', [BackController::class, 'showReviews'])->name('admin-reviews');
    Route::get('/countries', [BackController::class, 'showCountries'])->name('admin-countries');
    Route::get('/hotels', [BackController::class, 'showHotels'])->name('admin-hotels');
    Route::get('/travels', [BackController::class, 'showTravels'])->name('admin-travels');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
