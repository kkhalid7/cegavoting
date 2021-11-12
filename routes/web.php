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

Route::group(['middleware' => 'guest:web'], function () {
    Route::get('/login', function () {
        return view('web.login');
    })->name('login.index');

    Route::post('/get-voter', 'AuthController@getVoter')->name('get.voter');
    Route::post('/login', 'AuthController@authenticate')->name('voter.login');
});

Route::group(['middleware' => 'custom.auth:web'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::post('/cast-vote', 'VoterController@castVote')->name('cast.vote');
});


