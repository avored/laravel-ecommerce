<?php
Route::middleware(['web'])
    ->group(function () {
        Route::post('review', \AvoRed\Review\Http\Controllers\ReviewController::class)
            ->name('review.save');
    });


$baseAdminUrl = config('avored.admin_url');

Route::middleware(['web', 'admin.auth'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->group(function () {
        Route::post(
            'review/{productReview}/approved',
            \AvoRed\Review\Http\Controllers\Admin\ReviewController::class
        )->name('review.approved');
    });
