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

Route::middleware(['auth'])->group(function() {
    
    Route::resource('user', 'UserController');
    Route::resource('food', 'FoodController');
    Route::resource('category', 'CategoryController');
    Route::resource('service', 'ServiceController');
    Route::resource('city', 'CityController');
    Route::resource('place', 'PlaceController');
    Route::resource('hotel', 'HotelController');
    Route::resource('restaurant', 'RestaurantController');

});
