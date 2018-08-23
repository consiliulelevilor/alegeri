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

Route::group(['middleware' => ['cors']], function() {
    Route::get('/social/{social}', 'API\AuthenticationController@social')->name('social');
    Route::get('/social/{social}/confirmation', 'API\AuthenticationController@socialConfirmation')->name('social.confirmation');
});

Route::group(['middleware' => ['cors', 'auth:api']], function() {
    Route::get('/me', 'API\UserController@me')->name('me');

    Route::get('/user/{id}', 'API\UserController@show')->name('user');
});