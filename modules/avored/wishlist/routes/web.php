<?php

Route::middleware(['web', 'auth'])
    ->group(function () {
        Route::post('add-wishlist', [\AvoRed\Wishlist\Http\Controllers\WishlistController::class, 'store'])
            ->name('wishlist.store');
        Route::post(
            'remove-wishlist',
            [\AvoRed\Wishlist\Http\Controllers\WishlistController::class, 'destroy']
        )->name('wishlist.destroy');
    });
