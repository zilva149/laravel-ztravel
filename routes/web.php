<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationController;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::middleware('roles:Guest|Customer')->name('customer-')->group(function() {
    Route::get('/home', [FrontController::class, 'showHome'])->name('home');
    Route::get('/offers', [FrontController::class, 'showOffers'])->name('offers');
    Route::get('/offers/{destination}', [FrontController::class, 'showSingleOffer'])->name('single-offer');
    Route::get('/orders', [FrontController::class, 'showOrders'])->middleware('roles:Customer')->name('orders');
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

    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations');
    Route::get('/destinations/add', [DestinationController::class, 'create'])->name('destination-create');
    Route::post('/destinations/add', [DestinationController::class, 'store'])->name('destination-store');
    Route::get('/destinations/edit/{destination}', [DestinationController::class, 'edit'])->name('destination-edit');
    Route::put('/destinations/edit/{destination}', [DestinationController::class, 'update'])->name('destination-update');
    Route::delete('/destinations/delete/{destination}', [DestinationController::class, 'delete'])->name('destination-delete');

    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels');
    Route::get('/hotels/add', [HotelController::class, 'create'])->name('hotel-create');
    Route::post('/hotels/add', [HotelController::class, 'store'])->name('hotel-store');
    Route::get('/hotels/edit/{hotel}', [HotelController::class, 'edit'])->name('hotel-edit');
    Route::put('/hotels/edit/{hotel}', [HotelController::class, 'update'])->name('hotel-update');
    Route::delete('/hotels/delete/{hotel}', [HotelController::class, 'delete'])->name('hotel-delete');
    
    Route::get('/offers', [OfferController::class, 'index'])->name('offers');
    Route::get('/offers/add', [OfferController::class, 'create'])->name('offer-create');
    Route::post('/offers/add', [OfferController::class, 'store'])->name('offer-store');
    Route::get('/offers/edit/{offer}', [OfferController::class, 'edit'])->name('offer-edit');
    Route::put('/offers/edit/{offer}', [OfferController::class, 'update'])->name('offer-update');
    Route::delete('/offers/delete/{offer}', [OfferController::class, 'delete'])->name('offer-delete');

    Route::get('/api/destinations/{country}', [APIController::class, 'countryDestinations'])->name('api-country-destinations');
    Route::get('/api/hotels/{destination}', [APIController::class, 'destinationHotels'])->name('api-destination-hotels');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
