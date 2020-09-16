<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', 'LandingController@index')->name('landing');
Route::get( '/register', 'UserController@register')->name('register');
Route::post('/register', 'UserController@register_do')->name('register-do');
Route::get( '/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@login_do')->name('login-do');
Route::get( '/forgot', 'UserController@forgot')->name('forgot');

Route::middleware('auth')->group(function(){
    Route::get('/account', 'UserController@index')->name('account');
    Route::get('/account/addresses', 'UserAddressController@index')->name('account-addresses');

    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/cart/{category}/{product}/delete', 'CartController@delete');
    Route::get('/cart/checkout', 'CartController@checkout')->name('checkout-this-cart');
    
    Route::get('/checkout', 'CheckoutController@index')->name('checkout');

    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::get('/fund', 'FundController@index')->name('fund');
    Route::get('/fund/{category}', 'FundController@category');
    Route::get('/fund/{category}/{product}', 'FundController@detail');
    Route::post('/fund/{categoty}/{product}/checkout', 'FundController@checkout');

    Route::get('/logout', 'UserController@loggedOut')->name('logout');

    Route::get('/market', 'MarketController@index')->name('market');
    Route::get('/market/{category}', 'MarketController@category');
    Route::get('/market/{category}/{product}', 'MarketController@detail');
    Route::get('/market/{category}/{product}/wish', 'MarketController@wish');
    Route::post('/market/{category}/{product}/cart', 'MarketController@cart');

    Route::get('/payment/{invoice_code}/fund', 'PaymentController@fund');
    Route::post('/payment/{invoice_code}/fund', 'PaymentController@fund_pay');

    Route::get('/portofolio', 'PortofolioController@index')->name('portofolio');

    Route::get('/profile', 'ProfileController@index')->name('profile');

    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
});