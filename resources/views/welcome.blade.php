<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>{{ config('app.name', 'Todo list') }}</title>
</head>
<body>
<div id="app">
    <home></home>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
