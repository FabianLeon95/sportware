<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sportware') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .img-top{
            height: 56px;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>

<nav>
    <div class="center-align" style="padding: .2em">
        <a href="/" class="brand-logo"><img class="img-top" src="/images/logo-1.png" alt="Bulldogs"></a>
    </div>
</nav>

<div class="container" style="background-color: #eceff1;">
    @yield('content')
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>