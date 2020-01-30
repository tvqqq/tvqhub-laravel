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
        Route::get('/', 'Admin\AmaQuestionController@index');
        Route::get('{id}', 'Admin\AmaQuestionController@show')->name('detail');
        Route::put('{id}', 'Admin\AmaQuestionController@update')->name('update');
        Route::delete('{id}', 'Admin\AmaQuestionController@destroy')->name('destroy');
        Route::delete('force/{id}', 'Admin\AmaQuestionController@forceDelete')->name('forceDelete');
        Route::patch('restore/{id}', 'Admin\AmaQuestionController@restore')->name('restore');
    });
    Route::group(['prefix' => 'url', 'as' => 'url.'], function() {
        Route::get('/', 'Admin\UrlController@index');
        Route::get('{id}', 'Admin\UrlController@show')->name('detail');
    });
});

// AMA
Route::get('share/{id}', 'Admin\AmaQuestionController@share')->name('ama.share');

// Shorten link
Route::group(['domain' => 'ly.' . config('session.domain'), 'as' => 'site.url.'], function() {
    Route::get('/', 'Site\UrlController@index')->name('index');
    Route::post('/', 'Site\UrlController@create')->name('create');
});
