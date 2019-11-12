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


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
});


Route::group([
    'middleware' => 'auth:api'
], function() {

    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');

    Route::get('clients','ClientController@getList');
    Route::post('clients','ClientController@store');
    Route::get('clients/{id}','ClientController@find');
    Route::put('clients/{id}','ClientController@update');
    Route::delete('clients/{id}','ClientController@delete');

    Route::get('calls','CallController@getList');
    Route::post('calls','CallController@store');
    Route::get('calls/{id}','CallController@find');
    Route::put('calls/{id}','CallController@update');
    Route::delete('calls/{id}','CallController@delete');
});
