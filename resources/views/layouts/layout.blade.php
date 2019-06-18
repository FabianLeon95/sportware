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
</head>

<body class="dashboard">

<nav class="nav-extended">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo hide-on-large-only">{{ config('app.name', 'Laravel') }}</a>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul id="top-menu" class="right">
            <li><a class="dropdown-trigger user" data-target="user-dropdown">
                    <i class="material-icons">
                        account_circle
                    </i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<ul id="user-dropdown" class="dropdown-content">
    <li>
        <a href="#!">
            <i class="material-icons">person</i> {{ Auth::user()->name }}
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="#!"><i class="material-icons">settings</i> Settings
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"><i class="material-icons">exit_to_app</i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
    </li>
</ul>

@include('partials.layout.sidenav')
<main class="container mt-2">
    @yield('content')
</main>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>