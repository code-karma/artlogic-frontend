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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(array('prefix' => 'ct'), function() {
    Route::get('/products', function (Request $request) {
        return $request->fullUrl();
    });
    Route::get('/products', array('uses' => 'App\Http\Controllers\TestingController@getProducts'));
    //Route::get('/asset/{id}', array('uses' => 'TestingController@getAsset'));

});
