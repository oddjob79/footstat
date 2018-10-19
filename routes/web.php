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

Route::get('/', function () {
    return view('index');
});

/*Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::resource('leagues', 'LeaguesController');
    Route::resource('standings', 'StandingsController');
    Route::resource('matches', 'MatchesController');
    Route::resource('matchday', 'MatchesController@matchday');
});
*/