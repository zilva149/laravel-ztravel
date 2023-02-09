<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::middleware('roles:Customer')->group(function() {
    Route::get('/home', [FrontController::class, 'customerHome'])->name('customer-home');
});

Route::middleware('roles:Admin|Manager')->prefix('/admin')->name('admin-')->group(function() {
    Route::get('/home', [BackController::class, 'showHome'])->name('home');
    Route::get('/orders', [BackController::class, 'showOrders'])->name('orders');
    Route::get('/users', [BackController::class, 'showUsers'])->name('users');
    Route::get('/reviews', [BackController::class, 'showReviews'])->name('reviews');

    Route::get('/countries', [CountryController::class, 'index'])->name('countries');
    Route::get('/countries/add', [CountryController::class, 'create'])->name('country-create');
    Route::post('/countries/add', [CountryController::class, 'store'])->name('country-store');
    Route::get('/countries/edit/{country}', [CountryController::class, 'edit'])->name('country-edit');
    Route::put('/countries/edit/{country}', [CountryController::class, 'update'])->name('country-update');
    Route::delete('/countries/delete/{country}', [CountryController::class, 'delete'])->name('country-delete');

    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels');
    Route::get('/hotels/add', [HotelController::class, 'create'])->name('hotel-create');
    Route::post('/hotels/add', [HotelController::class, 'store'])->name('hotel-store');
    Route::get('/hotels/edit/{hotel}', [HotelController::class, 'edit'])->name('hotel-edit');
    Route::put('/hotels/edit/{hotel}', [HotelController::class, 'update'])->name('hotel-update');
    Route::delete('/hotels/delete/{hotel}', [HotelController::class, 'delete'])->name('hotel-delete');
    
    Route::get('/travels', [TravelController::class, 'index'])->name('travels');
    Route::get('/travels/add', [TravelController::class, 'create'])->name('travel-create');
    Route::post('/travels/add', [TravelController::class, 'store'])->name('travel-store');
    Route::get('/travels/edit/{travel}', [TravelController::class, 'edit'])->name('travel-edit');
    Route::put('/travels/edit/{travel}', [TravelController::class, 'update'])->name('travel-update');
    Route::delete('/travels/delete/{travel}', [TravelController::class, 'delete'])->name('travel-delete');

    Route::get('/travels/api/hotels/{country}', [APIController::class, 'countryHotels'])->name('api-travel-hotels');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
