<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Main page
Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('contact');

//Shop
Route::get('/shop', 'App\Http\Controllers\ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'App\Http\Controllers\ShopController@show')->name('shop.show');



//cart
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart', 'App\Http\Controllers\CartController@store')->name('cart.store');
Route::get('/cart/reset', 'App\Http\Controllers\CartController@reset')->name('cart.reset');
Route::delete('/cart/{product}', 'App\Http\Controllers\CartController@destroy')->name('cart.destroy');
Route::post('/cart/{product}/save', 'App\Http\Controllers\CartController@save')->name('cart.save');

//Save
Route::delete('/save/{product}', 'App\Http\Controllers\SaveController@destroy')->name('save.destroy');
Route::post('/save/{product}/cart', 'App\Http\Controllers\SaveController@store')->name('save.store');

//Checkout
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout')->name('checkout.index');
Route::post('/checkout', 'App\Http\Controllers\CheckoutController@store')->name('checkout.store');
Route::get('/checkout/success', 'App\Http\Controllers\CheckoutController@success')->name('checkout.success');

//Coupons
Route::post('/coupon', 'App\Http\Controllers\CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'App\Http\Controllers\CouponsController@destroy')->name('coupon.destroy');

//Orders
Route::get('/orders', 'App\Http\Controllers\HomeController@orders')->name('orders')->middleware('auth');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Auth::routes();


Route::get('/custom-logout',  function() {
    auth()->logout();
    Session()->flush();

    



    return Redirect::to('/');
})->name('custom-logout');
