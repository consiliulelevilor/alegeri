<?php


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

Route::group(['middleware' => [], 'as' => 'api.'], function () {
    Route::get('/json/regions', 'API\JSONController@regions')->name('regions');
    Route::get('/json/institutions', 'API\JSONController@institutions')->name('institutions');
});
