<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/url/logo.png') }}"/>
    <meta property="og:description" content="This is a url shortener to reduce a long link. Use our tool to shorten links and then share them, in addition you can monitor traffic statistics." />
    <meta property="og:image" content="{{ asset('images/url/logo.png') }}" />
    <title>Short Link by TVQhub</title>

    <!-- Scripts -->
    <script src="{{ asset('js/url.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Inconsolata&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b7e7ef4b41.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="app-url">
    <app :backend="{{ json_encode($backend) }}"></app>
</div>
</body>
</html>
