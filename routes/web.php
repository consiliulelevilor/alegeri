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

Route::get('/', 'HomeController@view')->name('home');

Route::get('/candidați', 'UserController@viewUsers')->name('users');
Route::get('/candidat/{idOrSlug}', 'UserController@viewUser')->name('user.profile');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/zona-candidatilor', 'AuthenticationController@view')->name('login');

    Route::get('/zona-candidatilor/{social}', 'AuthenticationController@socialLogin')->name('social.login');
    Route::get('/zona-candidatilor/{social}/confirmation', 'AuthenticationController@socialConfirmation')->name('social.confirmation');
});

Route::group(['middleware' => ['authenticated']], function () {
    Route::get('/logout', 'AuthenticationController@logout')->name('logout');
});
