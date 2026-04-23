<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pizzas/{pizza}', [HomeController::class, 'show'])->name('pizzas.show');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// Auth & Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', function() { 
        return view('pages.profile.index'); 
    })->name('profile');
});
