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