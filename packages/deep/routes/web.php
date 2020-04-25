<?php

Route::group([
    'domain' => 'deep' . config('session.domain'),
    'middleware' => 'web',
    'as' => 'deep.',
], function() {
    $controller = '\Deep\Controllers\DeepController';
    Route::get('/', "{$controller}@index")->name('index');
    Route::get('video', "{$controller}@indexVideo")->name('indexVideo');
    Route::get('999', "{$controller}@index999")->name('index999');
    Route::resource('posts', "{$controller}")->except('index');
    Route::get('latest', "{$controller}@latest")->name('latest');
});
