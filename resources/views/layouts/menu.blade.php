<?php
    $menu = [
        'home' => 'Home',
        'ama.' => 'AMA',
        'chinese-playlist.' => 'Chinese Playlist',
        //'shortlink.' => 'Short Link',
    ]
?>

<div class="list-group">
    @foreach($menu as $route => $name)
        <a href="{{ route($route) }}" class="list-group-item list-group-item-action {{ strpos(Route::currentRouteName(), $route) === 0 ? 'active' : '' }}">{{ $name }}</a>
    @endforeach
</div>
