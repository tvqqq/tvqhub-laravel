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
    Route::get('/{any}', 'Site\UrlController@redirect')->name('redirect');
    Route::group(['middleware' => 'auth:airlock'], function() {
        Route::post('/', 'Site\UrlController@create')->name('create');
        Route::post('/counter', 'Site\UrlController@counter')->name('counter');
    });
});

/**
 * Lar.tvqhub
 */
Auth::routes(['register' => false]);

// No Auth needed
Route::view('/', 'welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('share/{id}', 'Admin\AmaQuestionController@share')->name('ama.share'); // AMA share question to FB

// Admin (Auth needed)
Route::group(['middleware' => ['auth', 'prevent-airlock-user'], 'namespace' => 'Admin'], function() {
    Route::group(['prefix' => 'ama', 'as' => 'ama.'], function() {
        Route::get('/', 'AmaQuestionController@index');
        Route::get('{id}', 'AmaQuestionController@show')->name('show');
        Route::put('{id}', 'AmaQuestionController@update')->name('update');
        Route::delete('{id}', 'AmaQuestionController@destroy')->name('destroy');
        Route::delete('force/{id}', 'AmaQuestionController@forceDelete')->name('forceDelete');
        Route::patch('restore/{id}', 'AmaQuestionController@restore')->name('restore');
    });
    Route::resource('chinese-playlist', 'ChinesePlaylistController')->names([
        'index' => 'chinese-playlist.'
    ]);
    Route::resource('url', 'UrlController')->names([
        'index' => 'url.'
    ]);
    Route::group(['prefix' => 'facebooker', 'as' => 'facebooker.'], function() {
        Route::get('/', 'FacebookerController@index');
        Route::get('logs', 'FacebookerController@logs')->name('api.logs');
        Route::get('timer', 'FacebookerController@timer')->name('api.timer');
        Route::group(['prefix' => 'friends', 'as' => 'api.friends.'], function() {
            Route::get('/', 'FacebookerController@friends')->name('list');
            Route::patch('update', 'FacebookerController@updateFriends')->name('update');
            Route::patch('timer', 'FacebookerController@updateTimer')->name('timer');
        });
    });

});
