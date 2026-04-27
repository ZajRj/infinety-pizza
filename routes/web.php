<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pizzas/{pizza}', [HomeController::class, 'show'])->name('pizzas.show');

// Auth & Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', \App\Livewire\Pages\Profile\Index::class)->name('profile');
    Route::get('/checkout', \App\Livewire\Pages\Checkout\Index::class)->name('checkout');
});
