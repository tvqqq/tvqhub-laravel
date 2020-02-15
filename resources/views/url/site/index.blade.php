<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Short Link by TVQhub</title>

    <!-- Scripts -->
    <script src="{{ asset('js/url.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Inconsolata&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b7e7ef4b41.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="app-url">
    <app></app>
</div>
</body>
</html>
