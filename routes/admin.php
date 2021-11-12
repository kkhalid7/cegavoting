<?php


Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');

    Route::post('/authenticate', 'AuthController@authenticate')->name('authenticate');
});

Route::group(['middleware' => 'custom.auth:admin'], function () {

    Route::get('/','DashboardController@index')->name('dashboard');

    Route::get('/voters',  'VoterController@index')->name('voters');


    Route::get('/nominees', 'NomineeController@index')->name('nominees');
    Route::post('/nominees/add-category', 'NomineeController@addCategory')->name('add.categories');
    Route::post('/nominees/image', 'NomineeController@addImage')->name('nominee.image.store');

    Route::get('/categories', 'CategoryController@index')->name('categories');

    Route::get('/logout', 'AuthController@logout')->name('logout');

    Route::get('/importers', 'ImporterController@index')->name('importers');
    Route::post('/importers/store', 'ImporterController@store')->name('importers.store');
    Route::get('/importers/download-file/{file}', 'ImporterController@downloadFile')->name('importers.download-file');


    Route::get('/votes', 'VoteController@index')->name('votes');

    Route::get('/reset-election', 'DashboardController@resetVotes');

    Route::get('/chart-data', 'DashboardController@getVoteData');
});

