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
    Route::get('/json/regions', function () {
        return json_decode(cache('json:regions:raw'), true);
    })->name('regions');
    
    Route::get('/json/institutions', function () {
        return json_decode(cache('json:institutions:raw'), true);
    })->name('institutions');
});