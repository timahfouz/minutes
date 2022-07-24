<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'API'], function() {
    
    Route::get('places/{id?}', ['as' => 'places', 'uses' => 'PlaceController']);

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        Route::post('register', ['as' => 'register', 'uses' => 'AuthController@register']);
        Route::post('activate', ['as' => 'activate', 'uses' => 'AuthController@activate']);

        Route::get('logout', ['as' => 'logout.store', 'uses' => 'AuthController@logout'])->middleware('auth:api');
        Route::put('update', ['as' => 'profile.update', 'uses' => 'UserController@update'])->middleware('auth:api');
        Route::get('profile', ['as' => 'profile', 'uses' => 'UserController'])->middleware('auth:api');
    });
    

    Route::group(['middleware' => 'auth:api'], function() {
        
        Route::get('categories', ['as' => 'categories', 'uses' => 'CategoryController']);
        Route::get('products', ['as' => 'products', 'uses' => 'ProductController']);
        // Route::get('offers', ['as' => 'offers', 'uses' => 'OfferController']);
        Route::apiResource('carts', 'CartController');
        Route::post('checkout', ['as' => 'order.checkout', 'uses' => 'OrderController']);
        Route::get('orders', ['as' => 'orders.index', 'uses' => 'OrderController@index']);
        Route::get('orders/{id}', ['as' => 'orders.show', 'uses' => 'OrderController@show']);
        Route::get('settings/{key}', ['as' => 'settings', 'uses' => 'SettingsController']);
        Route::post('contact-us', ['as' => 'contact-us', 'uses' => 'SettingsController@contactUs']);
    
    });


    Route::group(['prefix' => 'carrier/auth','namespace' => 'Carrier', 'as' => 'carrier.'], function () {
        Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);

        Route::get('logout', ['as' => 'logout.store', 'uses' => 'AuthController@logout'])->middleware('auth:carrier');
    });


});