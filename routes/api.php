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

Route::group(['prefix' => 'airlock', 'namespace' => 'Auth', 'as' => 'airlock.'], function() {
    Route::get('csrf', 'AirlockController@csrf')->name('csrf');
    Route::post('login', 'AirlockController@login')->name('login');
});

Route::group(['middleware' => 'auth:airlock', 'namespace' => 'API', 'as' => 'api.'], function() {
    Route::group(['prefix' => 'ama'], function() {
        Route::get('/', 'AmaQuestionController@index');
        Route::post('/', 'AmaQuestionController@create');
    });

    Route::group(['prefix' => 'chinese-name'], function() {
        Route::post('/', 'ChineseNameController@index');
    });

    Route::group(['prefix' => 'chinese-playlist'], function() {
        Route::get('/', 'ChinesePlaylistController@index');
    });
});
