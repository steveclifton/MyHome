<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') My Weather App</title>

        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/mwa.css">
        <link rel="stylesheet" href="/css/app.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body>
        @include('layouts.navigation')

        @yield('content')

    </body>
    <script type="text/javascript" src="js/app.js"></script>
</html>
