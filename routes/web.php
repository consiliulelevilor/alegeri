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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/candidați', 'UserController@index')->name('users');
Route::get('/candidat/{idOrSlug}', 'UserController@show')->name('user.profile');
Route::get('/candidat/{idOrSlug}/aplicatii', 'UserController@showApplications')->name('user.applications');

Route::get('/login/social/{social}', 'AuthenticationController@social')->name('social');
Route::get('/login/social/{social}/confirmation', 'AuthenticationController@socialConfirmation')->name('social.confirmation');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', 'AuthenticationController@index')->name('login');
});

Route::group(['middleware' => ['authenticated']], function () {
    Route::get('/profilul-meu', 'UserController@me')->name('me');
    Route::patch('/profilul-meu', 'UserController@updateMe')->name('me.update');
    Route::get('/profilul-meu/{social}/deconectare', 'AuthenticationController@socialUnlink')->name('social.unlink');

    Route::get('/aplicatiile-mele', 'UserController@myApplications')->name('me.applications');

    Route::get('/aplica', 'CampaignController@index')->name('campaigns');
    Route::post('/aplica/{id}', 'CampaignController@apply')->name('campaign.apply');

    Route::patch('/me/picture', 'UserController@updateMyProfilePicture')->name('me.change.picture');

    Route::get('/logout', 'AuthenticationController@logout')->name('logout');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
