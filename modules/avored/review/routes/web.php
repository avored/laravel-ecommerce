<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
    ->group(function () {
        Route::post('review', [\AvoRed\Review\Http\Controllers\ReviewController::class, 'index'])
            ->name('review.save');

        Route::get('js/avored-review.js', [\AvoRed\Review\Http\Controllers\ReviewController::class, 'reviewJs'])
            ->name('avored.review.js'); 
    });

$baseAdminUrl = config('avored.admin_url');

Route::middleware(['web', 'admin.auth:admin'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->group(function () {
        Route::get('js/avored-review.js', [\AvoRed\Review\Http\Controllers\ReviewController::class, 'adminReviewJs'])
            ->name('avored.review.js');

        Route::post(
            'review/{productReview}/approved',
            \AvoRed\Review\Http\Controllers\Admin\ReviewController::class
        )->name('review.approved');
    });
