<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $question->question }}</title>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{ $question->question }}"/>
    <meta property="og:description" content="{{ strip_tags($question->answer) }}"/>
    <meta property="og:image" content="{{ asset('images/ama-tvq-400.png') }}"/>
</head>

<body>
<script>
    location.href = '{{ config('tvqhub.base_domain') }}/ama';
</script>
</body>
</html>
