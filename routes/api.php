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

Route::get('ad', '\App\Http\Controllers\AdController@index')->name('ad.index');
Route::post('ad', '\App\Http\Controllers\AdController@store')->name('ad.store');
Route::get('ad/{ad}', '\App\Http\Controllers\AdController@oneAd')->name('ad.one');
