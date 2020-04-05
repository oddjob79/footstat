<?php

use Illuminate\Http\Request;

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

Route::middleware('api')->group(function() {
    Route::apiResource('/leagues', 'API\LeaguesController');
    Route::apiResource('/standings', 'API\StandingsController');
    Route::apiResource('/matches', 'API\MatchesController');
    Route::get('/matchday/{id}/{matchday}', 'API\MatchesController@matchday');

// get stats via python script
    Route::apiResource('/stats', 'API\StatsController');

// routes to gather data and populate tables
    Route::get('apifootballtest', 'API\ApiFootballTestController@index'); // TEST ONLY

    Route::get('populateareas', 'API\AreaController@populate');
    Route::get('populateteams', 'API\TeamController@populate');
    Route::get('populateleagues', 'API\LeaguesController@populate');
    Route::get('populatestandings', 'API\StandingsController@populate');

});
