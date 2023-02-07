<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::middleware('roles:Customer')->group(function() {
    Route::get('/home', [FrontController::class, 'customerHome'])->name('customer-home');
});

Route::middleware('roles:Admin|Manager')->prefix('/admin')->group(function() {
    Route::get('/home', [BackController::class, 'showHome'])->name('admin-home');
    Route::get('/orders', [BackController::class, 'showOrders'])->name('admin-orders');
    Route::get('/users', [BackController::class, 'showUsers'])->name('admin-users');
    Route::get('/reviews', [BackController::class, 'showReviews'])->name('admin-reviews');

    Route::get('/countries', [CountryController::class, 'index'])->name('admin-countries');
    Route::get('/countries/add', [CountryController::class, 'create'])->name('admin-country-create');
    Route::post('/countries/add', [CountryController::class, 'store'])->name('admin-country-store');
    Route::get('/countries/edit/{country}', [CountryController::class, 'edit'])->name('admin-country-edit');
    Route::put('/countries/edit/{country}', [CountryController::class, 'update'])->name('admin-country-update');
    Route::delete('/countries/delete/{country}', [CountryController::class, 'delete'])->name('admin-country-delete');
    
    Route::get('/hotels', [BackController::class, 'showHotels'])->name('admin-hotels');
    Route::get('/hotels/add', [BackController::class, 'showAddHotel'])->name('admin-add-hotel');
    Route::get('/travels', [BackController::class, 'showTravels'])->name('admin-travels');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
