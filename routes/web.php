<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Account\OrderCommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('', 'HomeController@index')->name('home');

Route::get('category/{category}', 'Category\CategoryController@show')->name('category.show');
Route::get('product/{product}', 'Product\ProductController@show')->name('product.show');

Route::get('cart', 'Cart\CartController@show')->name('cart.show');
Route::post('apply-promotion-code/{code}', 'Cart\CartController@applyPromotionCode')->name('promotion-code.apply');
Route::post('add-to-cart', 'Cart\CartController@addToCart')->name('add.to.cart');
Route::delete('destroy-cart', 'Cart\CartController@destroy')->name('cart.destroy');
Route::put('update-cart', 'Cart\CartController@update')->name('cart.update');

Route::get('checkout', 'Checkout\CheckoutController@show')->name('checkout.show');
Route::post('order', 'Order\OrderController@place')->name('order.place');

Route::get('order/{order}', 'Order\OrderController@successful')->name('order.successful');

Route::middleware('auth:customer')
    ->name('account.')
    ->prefix('account')
    ->namespace('Account')
    ->group(function () {
        Route::get('', 'DashboardController@index')->name('dashboard');
        Route::get('edit', EditController::class)->name('edit');
        Route::get('upload', UploadController::class)->name('upload');
        Route::post('save', SaveController::class)->name('save');
        Route::post('password', UpdatePasswordController::class)->name('password');
        Route::post('upload-image', UploadImageController::class)->name('upload.image');
        Route::resource('address', 'AddressController');
        Route::resource('order', 'OrderController')->only(['index', 'show']);
        Route::resource('order/{order}/order-comment', 'OrderCommentController');
        Route::get(
            'wishlist', 
            [\AvoRed\Wishlist\Http\Controllers\AccountWishlistController::class, 'index']
        )->name('wishlist.index');
    });
