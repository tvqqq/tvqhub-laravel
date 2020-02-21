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

Route::post('login-airlock', 'Auth\LoginController@loginAirlock');

Route::group(['middleware' => 'auth:airlock'], function() {
    Route::group(['prefix' => 'ama'], function() {
        Route::get('/', 'API\AmaQuestionController@index');
        Route::post('/', 'API\AmaQuestionController@create');
    });

    Route::group(['prefix' => 'chinese-name'], function() {
        Route::post('/', 'API\ChineseNameController@index');
    });

    Route::group(['prefix' => 'chinese-playlist'], function() {
        Route::get('/', 'API\ChinesePlaylistController@index');
    });
});
