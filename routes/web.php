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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'ama', 'as' => 'ama.'], function() {
        Route::get('/', 'Admin\AmaQuestionController@index')->name('index');
        Route::get('{id}', 'Admin\AmaQuestionController@show')->name('detail');
        Route::post('{id}', 'Admin\AmaQuestionController@update')->name('update');
        Route::delete('{id}', 'Admin\AmaQuestionController@destroy')->name('destroy');
    });
});
