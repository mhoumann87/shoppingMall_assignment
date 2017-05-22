<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('stores', 'StoreController');
//Route::resource('stores/{id}', 'StoreController@show');
Route::resource('subscriptions', 'SubscriptionController');
Route::resource('customers', 'CustomerController');
//Route::resource('customers/{id}', 'CustomerController@show');
//Route::resource('customers/add', 'CustomerController@store');
Route::resource('offers', 'OfferController');




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
