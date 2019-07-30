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
    @yield('styles')
</head>

<body class="dashboard">

<nav class="nav-extended">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo hide-on-large-only"><img class="materialboxed" src="/images/logo-1.png" height="56px" alt=""></a>
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
@yield('progress')

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
{{--SIDNAV--}}
<ul id="nav-mobile" class="sidenav sidenav-fixed">
    <li class="logo">
        {{ config('app.name', 'Laravel') }}
    </li>
    {{--    <li><a href="#!">First Sidebar Link</a></li>--}}
    {{--    <li><a href="#!">Second Sidebar Link</a></li>--}}
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            @if(Auth::user()->hasRoles('admin'))
                <li>
                    <a class="collapsible-header">Users<i class="material-icons">
                            chevron_right
                        </i> </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('users.index')}}">Users</a></li>
                            <li><a href="{{ route('users.create') }}">Add User</a></li>
                        </ul>
                    </div>
                </li>
            @endif
            @if(Auth::user()->hasRoles('admin','stats'))
                <li>
                    <a class="collapsible-header">Players<i class="material-icons">
                            chevron_right
                        </i> </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('players.index')}}">Players</a></li>
                            <li><a href="{{ route('players.create') }}">Add Player</a></li>
                            <li><a href="{{route('rookies.index')}}">Rookies</a></li>
                            <li><a href="{{ route('rookies.create') }}">Add Rookie</a></li>
                            <li><a href="{{ route('positions.index') }}">Positions</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="collapsible-header">Games<i class="material-icons">
                            chevron_right
                        </i> </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('seasons.index')}}">Seasons</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="collapsible-header">Events<i class="material-icons">
                            chevron_right
                        </i> </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('players.index')}}">Calendar</a></li>
                            <li><a href="{{ route('category.index') }}">Event Categories</a></li>
                        </ul>
                    </div>
                </li>
            @endif
            @if(Auth::user()->hasRoles('admin','medic'))
                <li><a href="{{ route('medical.index') }}" style="padding: 0 16px">Medical</a></li>
            @endif
        </ul>
    </li>
</ul>
{{--END_SIDNAV--}}

<main class="container mt-2">
    @yield('content')
</main>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')
</body>

</html>