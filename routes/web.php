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

Route::get('', 'HomeController@index')->name('home');

Route::get('category/{slug}', 'CategoryViewController@view')->name('category.view');
Route::get('product/{slug}', 'ProductViewController@view')->name('product.view');
Route::get('product-search', 'SearchController@result')->name('search.result');

Route::post('product-demo-download', 'ProductViewController@downloadDemoProduct')->name('product.demo.download');

Route::post('add-to-cart', 'CartController@addToCart')->name('cart.add-to-cart');
Route::get('cart/view', 'CartController@view')->name('cart.view');
Route::put('cart/update', 'CartController@update')->name('cart.update');
Route::get('cart/destroy/{id}', 'CartController@destroy')->name('cart.destroy');

Route::get('checkout', 'CheckoutController@index')->name('checkout.index');

Route::post('checkout-field-updated', 'CheckoutController@checkoutFieldUpdated')->name('checkout.field.updated');

Route::get('login/{provider}', 'Auth\LoginController@providerLogin')->name('login.provider');
Route::get('login/{provider}/callback', 'Auth\LoginController@providerCallback')->name('provider.callback');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.token');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

Route::get('order', 'OrderController@index')->name('order.index');
Route::post('order', 'OrderController@place')->name('order.place');
Route::get('order/success/{order}', 'OrderController@success')->name('order.success');

Route::get('page/{slug}', 'PageController@show')->name('page.show');

Route::middleware(['auth', 'verified'])
    ->prefix('my-account')
    ->name('my-account.')
    ->group(function () {
        Route::get('', 'User\MyAccountController@home')->name('home');
        Route::get('edit', 'User\MyAccountController@edit')->name('edit');
        Route::post('edit', 'User\MyAccountController@store')->name('store');
        Route::get('upload-image', 'User\MyAccountController@uploadImage')->name('upload-image');
        Route::post('upload-image', 'User\MyAccountController@uploadImagePost')->name('upload-image.post');
        Route::get('change-password', 'User\MyAccountController@changePassword')->name('change-password');
        Route::post('change-password', 'User\MyAccountController@changePasswordPost')->name('change-password.post');

        Route::resource('address', 'User\AddressController');

        Route::get('order/list', 'OrderController@myAccountOrderList')->name('order.list');
        Route::get('order/{order}/view', 'OrderController@myAccountOrderView')->name('order.view');
        Route::get('order/{order}/return', 'OrderController@return')
                        ->name('order.return');
        Route::post('order/{order}/return', 'OrderController@returnPost')
                        ->name('order.return.post');

        Route::get('wishlist/add/{slug}', 'User\WishlistController@add')->name('wishlist.add');
        Route::get('wishlist', 'User\WishlistController@mylist')->name('wishlist.list');
        Route::get('wishlist/remove/{slug}', 'User\WishlistController@destroy')->name('wishlist.remove');

        Route::post('product-main-download', 'ProductViewController@downloadMainProduct')
                    ->name('product.main.download');
    });
