<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RestaurantController::class, 'index'])->name('home');
Route::get('/explore', [RestaurantController::class, 'explore'])->name('explore');
Route::get('/restaurants/{restaurant:slug}', [RestaurantController::class, 'show'])->name('restaurants.show');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [RestaurantController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/restaurants/{restaurant}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::post('/reviews/{review}/vote', [VoteController::class, 'toggle'])->name('reviews.vote');
});

require __DIR__ . '/auth.php';
