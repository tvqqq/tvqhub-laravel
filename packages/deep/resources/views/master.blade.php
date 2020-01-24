<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('deep.title') }} @yield('title')</title>
    <meta property="og:description" content="@yield('description', config('deep.description'))"/>
    <meta property="og:image" content="@yield('ogimage', asset('packages/deep/images/logo-400.png'))"/>
    <meta property="fb:app_id" content="949098545458729"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('packages/deep/images/favicon.png') }}"/>
    <link href="https://fonts.googleapis.com/css?family=Inconsolata&display=swap" rel="stylesheet">
    @stack('css')
    <link rel="stylesheet" href="{{ asset('packages/deep/css/style.css') }}"/>
</head>
<body>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154201677-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-154201677-2');
</script>

<!-- Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=949098545458729&autoLogAppEvents=1"></script>

<div class="container">
    <div class="top">
        <a href="/">
            <img src="{{ asset('packages/deep/images/logo.png') }}" width="150" alt="{{ config('deep.title') }}"/>
        </a>
        <p>{{ config('deep.description') }}</p>
        <ul class="menu">
            <li><a href="{{ route('deep.indexVideo') }}">#video</a></li>
            <li><a href="https://tvqhub.com">#tvqhub</a></li>
        </ul>
        <p></p>
    </div>

    @yield('content')
</div>

<script src="{{ asset('vendor/jquery/jquery-3.4.1.min.js') }}"></script>
@stack('js')
</body>
