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

Route::middleware(['auth'])->group(function() {

    // Redirects
    Route::get('', function() { return redirect()->route('user.index'); });

    // Resources
    Route::resource('user', 'UserController')->middleware('role:admin|ssad');
    Route::resource('food', 'FoodController');
    Route::resource('category', 'CategoryController');
    Route::resource('service', 'ServiceController');
    Route::resource('city', 'CityController');
    Route::resource('place', 'PlaceController');
    Route::resource('hotel', 'HotelController');
    Route::resource('restaurant', 'RestaurantController');

    // Other
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

});


Route::middleware('guest')->group(function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
});
