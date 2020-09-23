<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:customer'])
    ->group(function () {
        Route::post(
            'add-wishlist', 
            [\AvoRed\Wishlist\Http\Controllers\WishlistController::class, 'store']
        )->name('wishlist.store');
        
        Route::post(
            'remove-wishlist',
            [\AvoRed\Wishlist\Http\Controllers\WishlistController::class, 'destroy']
        )->name('wishlist.destroy');
    });
