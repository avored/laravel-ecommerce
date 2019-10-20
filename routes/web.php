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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('', 'HomeController@index')->name('home');

Route::get('category/{category}', 'CategoryController@show')->name('category.show');
Route::get('product/{product}', 'ProductController@show')->name('product.show');

Route::get('cart', 'CartController@show')->name('cart.show');
Route::post('add-to-cart', 'CartController@addToCart')->name('add.to.cart');
Route::delete('destroy-cart', 'CartController@destroy')->name('cart.destroy');
Route::put('update-cart', 'CartController@update')->name('cart.update');

Route::get('checkout', 'CheckoutController@show')->name('checkout.show');
Route::post('order', 'OrderController@place')->name('order.place');

Route::get('order/{order}', 'OrderController@successful')->name('order.successful');

Route::middleware('auth')
    ->name('account.')
    ->prefix('account')
    ->namespace('Account')
    ->group(function () {
        Route::get('', 'DashboardController@index')->name('dashboard');
        Route::get('edit', EditController::class)->name('edit');
        Route::get('upload', UploadController::class)->name('upload');
        Route::post('save', SaveController::class)->name('save');
        Route::post('upload-image', UploadImageController::class)->name('upload.image');
        Route::resource('address', 'AddressController');
        Route::resource('order', 'OrderController')->only(['index', 'show']);
    });
