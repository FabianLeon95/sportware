<ul id="nav-mobile" class="sidenav sidenav-fixed">
    <li class="logo center-align">
        <img src="/images/logo-3.png" height="56px" style="margin: 0.5em auto" alt="">
    </li>
    @if(Auth::user()->hasRoles('admin'))
    <li>
        <a href="{{ route('users.index') }}" style="padding: 0 16px">
            <i class="material-icons left" style="margin-right: 1rem">person</i>
            Users
        </a>
    </li>
    @endif
    @if(Auth::user()->hasRoles('admin','medic'))
        <li>
            <a href="{{ route('medical.index') }}" style="padding: 0 16px">
                <i class="fas fa-notes-medical" style="float: left !important;margin-right: 1rem;font-size: 1.6rem;"></i>
                Medical</a>
        </li>
    @endif
    @if(Auth::user()->hasRoles('admin','stats','player'))
        <li>
            <a href="#" style="padding: 0 16px">
                <i class="fas fa-chart-bar" style="float: left !important;margin-right: 1rem;font-size: 1.6rem;"></i>
                Stats</a>
        </li>
    @endif
    @if(Auth::user()->hasRoles('admin','stats','medic'))
        <li>
            <a href="{{ route('notification.index') }}" style="padding: 0 16px">
                <i class="fas fa-envelope" style="float: left !important;margin-right: 1rem;font-size: 1.6rem;"></i>
                Notifications</a>
        </li>
    @endif
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            @if(Auth::user()->hasRoles('admin','stats'))
                <li>
                    <a class="collapsible-header">
                        <i class="fas fa-running" style="float: left !important;margin-right: 1rem;"></i>
                        Players<i class="material-icons">
                            chevron_right
                        </i> </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('players.index')}}">Players</a></li>
                            <li><a href="{{route('rookies.index')}}">Rookies</a></li>
                            <li><a href="{{ route('positions.index') }}">Positions</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="collapsible-header">
                        <i class="fas fa-football-ball" style="float: left !important;margin-right: 1rem;"></i>
                        Games<i class="material-icons">
                            chevron_right
                        </i> </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('teams.index')}}">Teams</a></li>
                            <li><a href="{{route('seasons.index')}}">Seasons</a></li>
                            <li><a href="{{route('match.index')}}">Matches</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="collapsible-header"><i class="fas fa-calendar-alt" style="float: left !important;margin-right: 1rem;"></i>Events<i class="material-icons">
                            chevron_right
                        </i> </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('events.index')}}">Calendar</a></li>
                            <li><a href="{{ route('category.index') }}">Event Categories</a></li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </li>
</ul>