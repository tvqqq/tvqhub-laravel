<?php
    $menu = [
        'home' => 'Home',
        'settings.' => '§ettings',
        'ama.' => 'AMA',
        'chinese-playlist.' => 'Chinese Playlist',
        'url.' => 'Short Link (URL)',
        'facebooker.' => 'Facebooker',
    ]
?>

<div class="list-group">
    @foreach($menu as $route => $name)
        <a href="{{ route($route) }}" class="list-group-item list-group-item-action {{ strpos(Route::currentRouteName(), $route) === 0 ? 'active' : '' }}">{{ $name }}</a>
    @endforeach
</div>
