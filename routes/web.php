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

/**
 * Subdomain need to defined all above main domain.
 */

// URL Shorten link
Route::group(['domain' => 'ly' . config('session.domain'), 'as' => 'url.site.'], function() {
    Route::get('/', 'Site\UrlController@index')->name('index');
    Route::post('/', 'Site\UrlController@create')->name('create');
    Route::post('/counter', 'Site\UrlController@counter')->name('counter');
    Route::get('/{any}', 'Site\UrlController@redirect')->name('redirect');
    Route::get('/{vue_capture?}', function () { return view('url.site.index'); })->where('vue_capture', '[\/\w\.-]*');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// AMA share question to FB
Route::get('share/{id}', 'Admin\AmaQuestionController@share')->name('ama.share');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'ama', 'as' => 'ama.'], function() {
        Route::get('/', 'Admin\AmaQuestionController@index');
        Route::get('{id}', 'Admin\AmaQuestionController@show')->name('show');
        Route::put('{id}', 'Admin\AmaQuestionController@update')->name('update');
        Route::delete('{id}', 'Admin\AmaQuestionController@destroy')->name('destroy');
        Route::delete('force/{id}', 'Admin\AmaQuestionController@forceDelete')->name('forceDelete');
        Route::patch('restore/{id}', 'Admin\AmaQuestionController@restore')->name('restore');
    });
    Route::resource('chinese-playlist', 'Admin\ChinesePlaylistController')->names([
        'index' => 'chinese-playlist.'
    ]);
    Route::resource('url', 'Admin\UrlController')->names([
        'index' => 'url.'
    ]);
});
