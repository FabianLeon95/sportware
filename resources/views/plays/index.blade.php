@extends('layouts.layout')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <style>
        td, th {
            padding: 12px 8px;
        }

        .table-scroll {
            overflow-y: scroll;
            max-height: 380px;
        }

        .table-scroll .fixed thead th {
            position: sticky;
            top: 0;
            background-color: #f5f5f5;
        }

        .table-centered td, .table-centered th {
            text-align: center;
        }

        .ball {
            color: #FFCD0A;
            margin-right: 0.5rem;
        }

        .table-title {
            background-color: #000060;
            color: #fff;
        }
        .table-subtitle {
            background-color: rgba(0, 0, 173, 0.2);
            color: #000060;
        }
    </style>
@stop

@section('content')
    <div class="row py-1">
        <div class="col s12">
            <div class="card">
                <div class="card-content blue-grey darken-4 white-text">
                    <div class="row">
                        <div class="col s6 center-align">
                            <h5>
                                @if ($currentPlay->team_id == $match->home_team_id)
                                    <i class="fas fa-football-ball ball"></i>
                                @endif
                                {{ $match->homeTeam->name }}
                            </h5>
                            <h4>{{ $score['home']}}</h4>
                        </div>
                        <div class="col s6 center-align">
                            <h5>
                                @if ($currentPlay->team_id == $match->visit_team_id)
                                    <i class="fas fa-football-ball ball"></i>
                                @endif
                                {{ $match->visitTeam->name }}
                            </h5>
                            <h4>{{ $score['visit'] }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        @if ($currentPlay->quarter < 5)

                            <div class="col s3 center-align">
                                Down: {{ $currentPlay->down }}
                            </div>
                            <div class="col s3 center-align">
                                To go: {{ $currentPlay->to_go }}
                            </div>
                            <div class="col s3 center-align">
                                Ball on: {{ $currentPlay->ball_on }}
                            </div>
                            <div class="col s3 center-align">
                                QTR: {{ $currentPlay->quarter }}
                            </div>

                        @else
                            <div class="col s12 center-align">
                                <span style="font-size: 24px">Match Ended</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a href="#event">Add Event</a></li>
                        <li class="tab"><a href="#plays">Plays</a></li>
                        <li class="tab"><a href="#stats" id="stats-tab">Stats</a></li>
                    </ul>
                </div>
                <div class="card-content grey lighten-4">
                    <div id="event">
                        <div class="row">
                            <div class="col s12 py-2 center-align">
                                <form action="{{ route('plays.end-quarter', $match) }}" method="POST">
                                    @csrf
                                    <a href="#end-quarter" class="btn btn-primary waves-effect modal-trigger">
                                        @if ($currentPlay->quarter < 5)
                                            End
                                            @switch($currentPlay->quarter)
                                                @case(1)
                                                1st
                                                @break
                                                @case(2)
                                                2nd
                                                @break
                                                @case(3)
                                                3rd
                                                @break
                                                @case(4)
                                                4th
                                                @break
                                            @endswitch
                                            Quarter
                                        @else
                                            Reopen Game
                                        @endif
                                    </a>
                                    <div id="end-quarter" class="modal left-align">
                                        <div class="modal-content">
                                            <h4><i class="material-icons icon yellow-text">warning</i>Alert</h4>
                                            @if ($currentPlay->quarter < 4)
                                                <p>Are you sure you want to advance to next quarter?</p>
                                            @elseif($currentPlay->quarter == 4)
                                                <p>Are you sure you want to end this game?</p>
                                            @else
                                                <p>The game has ended. Do you want to reopen the game so that you can
                                                    enter plays?</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="modal-close grey btn waves-effect">No</button>
                                            <button type="submit" class="modal-close btn waves-effect">Yes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if ($currentPlay->quarter < 5)
                                <div class="col s6 py-2">
                                    <a href="#modal1" class="btn btn-big valign-wrapper modal-trigger">
                                        Special Teams
                                    </a>
                                </div>
                                <div class="col s6 py-2">
                                    <a href="{{ route('plays.penalty-bs', $match) }}"
                                       class="btn btn-big valign-wrapper">
                                        Penality Before Snap
                                    </a>
                                </div>
                                <div class="col s6 py-2">
                                    <a href="{{ route('plays.run', $match) }}" class="btn btn-big valign-wrapper">
                                        Run
                                    </a>
                                </div>
                                <div class="col s6 py-2">
                                    <a href="{{ route('plays.pass', $match) }}" class="btn btn-big valign-wrapper">
                                        Pass
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div id="plays">
                        <div id="scroll" class="table-scroll fixed">
                            <table class="table-centered">
                                <thead>
                                <tr>
                                    <th>Quarter</th>
                                    <th>Offense</th>
                                    <th>Down</th>
                                    <th>Ball On</th>
                                    <th>Point for</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @for ($i = 0; $i < count($plays); $i++)
                                    <tr>
                                        <td>{{ $plays[$i]->quarter < 5 ? $plays[$i]->quarter : 'End' }}</td>
                                        <td>{{ $plays[$i]->team->name }}</td>
                                        <td>{{ $plays[$i]->down }}</td>
                                        <td>{{ $plays[$i]->ball_on }}</td>
                                        <td>
                                            @if ($plays[$i]->home_points != 0)
                                                <span class="green-text">{{ $match->homeTeam->name }}</span>
                                            @elseif ($plays[$i]->visit_points != 0)
                                                <span class="green-text">{{ $match->visitTeam->name }}</span>
                                            @else
                                                <span class="red-text">Any</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($i == (count($plays)-1))
                                                <a class="modal-trigger btn-icon btn-flat waves-effect red-text"
                                                   href="#delete-confirm-{{ $plays[$i]->id }}">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <div id="delete-confirm-{{ $plays[$i]->id }}" class="modal left-align">
                                                    <div class="modal-content">
                                                        <h4><i class="material-icons icon">warning</i>Warning</h4>
                                                        <p>The action to be performed needs confirmation</p>
                                                    </div>
                                                    <form action="{{ route('plays.delete', $plays[$i]) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-footer">
                                                            <a class="modal-close grey btn waves-effect">Cancel</a>
                                                            <button type="submit" class="modal-close btn waves-effect">
                                                                Agree
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="stats">
                        <div class="table-scroll">
                            <table>
                                <tr class="table-title">
                                    <th colspan="6">Box Score</th>
                                </tr>
                                <tr>
                                    <th>Team</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>T</th>
                                </tr>
                                <tr>
                                    <td>{{ $match->homeTeam->name }}</td>
                                    @for ($i = 0; $i < count($stats['boxScore']['quarters']); $i++)
                                        <td>
                                            {{ $stats['boxScore']['quarters'][$i]['home_points'] }}
                                        </td>
                                    @endfor
                                    @for ($i = 0; $i < 4 - count($stats['boxScore']['quarters']); $i++)
                                        <td>
                                            0
                                        </td>
                                    @endfor
                                    <td>{{ $stats['boxScore']['home_total'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $match->visitTeam->name }}</td>
                                    @for ($i = 0; $i < count($stats['boxScore']['quarters']); $i++)
                                        <td>
                                            {{ $stats['boxScore']['quarters'][$i]['visit_points'] }}
                                        </td>
                                    @endfor
                                    @for ($i = 0; $i < 4 - count($stats['boxScore']['quarters']); $i++)
                                        <td>
                                            0
                                        </td>
                                    @endfor
                                    <td>{{ $stats['boxScore']['visit_total'] }}</td>
                                </tr>
                            </table>
                            <table>
                                <tr class="table-title">
                                    <th colspan="3">Team Stat Comparison</th>
                                </tr>
                                <tr>
                                    <th>Stat</th>
                                    <th>{{ $match->homeTeam->name }}</th>
                                    <th>{{ $match->visitTeam->name }}</th>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Total Offense</th>
                                    <td>{{ $stats['offense']['home']['total_offense'] }}</td>
                                    <td>{{ $stats['offense']['visit']['total_offense'] }}</td>
                                </tr>
                                <tr>
                                    <th>Number of plays</th>
                                    <td>{{ $stats['offense']['home']['number_of_plays'] }}</td>
                                    <td>{{ $stats['offense']['visit']['number_of_plays'] }}</td>
                                </tr>
                                <tr>
                                    <th>Yards per play</th>
                                    <td>{{ $stats['offense']['home']['yards_per_play'] }}</td>
                                    <td>{{ $stats['offense']['visit']['yards_per_play'] }}</td>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Passing</th>
                                    <td>{{ $stats['passing']['home']['passing'] }}</td>
                                    <td>{{ $stats['passing']['visit']['passing'] }}</td>
                                </tr>
                                <tr>
                                    <th>Completions / Attempts</th>
                                    <td>{{ $stats['passing']['home']['completions'] }} / {{ $stats['passing']['home']['attempts'] }}</td>
                                    <td>{{ $stats['passing']['visit']['completions'] }} / {{ $stats['passing']['visit']['attempts'] }}</td>
                                </tr>
                                <tr>
                                    <th>Touchdowns</th>
                                    <td>{{ $stats['passing']['home']['touchdowns'] }}</td>
                                    <td>{{ $stats['passing']['visit']['touchdowns'] }}</td>
                                </tr>
                                <tr>
                                    <th>Interceptions</th>
                                    <td>{{ $stats['passing']['home']['interceptions'] }}</td>
                                    <td>{{ $stats['passing']['visit']['interceptions'] }}</td>
                                </tr>
                                <tr>
                                    <th>Yards per pass</th>
                                    <td>{{ $stats['passing']['home']['yards_per_pass'] }}</td>
                                    <td>{{ $stats['passing']['visit']['yards_per_pass'] }}</td>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Rushing</th>
                                    <td>{{ $stats['rushing']['home']['rushing'] }}</td>
                                    <td>{{ $stats['rushing']['visit']['rushing'] }}</td>
                                </tr>
                                <tr>
                                    <th>Rushing Attempts</th>
                                    <td>{{ $stats['rushing']['home']['rushing_attempts'] }}</td>
                                    <td>{{ $stats['rushing']['visit']['rushing_attempts'] }}</td>
                                </tr>
                                <tr>
                                    <th>Yards per rush</th>
                                    <td>{{ $stats['rushing']['home']['yards_per_rush'] }}</td>
                                    <td>{{ $stats['rushing']['visit']['yards_per_rush'] }}</td>
                                </tr>
                                <tr>
                                    <th>Touchdowns</th>
                                    <td>{{ $stats['rushing']['home']['touchdowns'] }}</td>
                                    <td>{{ $stats['rushing']['visit']['touchdowns'] }}</td>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Penalties</th>
                                    <td>{{ $stats['penalties']['home']['penalties'] }}</td>
                                    <td>{{ $stats['penalties']['visit']['penalties'] }}</td>
                                </tr>
                                <tr>
                                    <th>Loss of yards</th>
                                    <td>{{ $stats['penalties']['home']['yards_loss'] }}</td>
                                    <td>{{ $stats['penalties']['visit']['yards_loss'] }}</td>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Turnovers</th>
                                    <td>{{ $stats['turnovers']['home']['turnovers'] }}</td>
                                    <td>{{ $stats['turnovers']['visit']['turnovers'] }}</td>
                                </tr>
                                <tr>
                                    <th>Fumbles</th>
                                    <td>{{ $stats['turnovers']['home']['fumbles'] }}</td>
                                    <td>{{ $stats['turnovers']['visit']['fumbles'] }}</td>
                                </tr>
                                <tr>
                                    <th>Interceptions</th>
                                    <td>{{ $stats['turnovers']['home']['interceptions'] }}</td>
                                    <td>{{ $stats['turnovers']['visit']['interceptions'] }}</td>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Punting attempts</th>
                                    <td>{{ $stats['punts']['home']['attempts'] }}</td>
                                    <td>{{ $stats['punts']['visit']['attempts'] }}</td>
                                </tr>
                                <tr>
                                    <th>Average distance</th>
                                    <td>{{ $stats['punts']['home']['average_distance'] }}</td>
                                    <td>{{ $stats['punts']['visit']['average_distance'] }}</td>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Sacks</th>
                                    <td>{{ $stats['sacks']['home']['defensive_sacks'] }}</td>
                                    <td>{{ $stats['sacks']['visit']['defensive_sacks'] }}</td>
                                </tr>
                                <tr>
                                    <th>Yards</th>
                                    <td>{{ $stats['sacks']['home']['yards'] }}</td>
                                    <td>{{ $stats['sacks']['visit']['yards'] }}</td>
                                </tr>
                                <tr class="table-subtitle">
                                    <th colspan="3">Down</th>
                                </tr>
                                <tr>
                                    <th>First Downs</th>
                                    <td>{{ $stats['firstDowns']['home'] }}</td>
                                    <td>{{ $stats['firstDowns']['visit'] }}</td>
                                </tr>
                                <tr>
                                    <th>Third Down Conversions / Attempts</th>
                                    <td>{{ $stats['thirdDownConversions']['home']['conversions'] }}/{{ $stats['thirdDownConversions']['home']['attempts'] }}
                                        ({{ $stats['thirdDownConversions']['home']['percentage'] }}%)</td>
                                    <td>{{ $stats['thirdDownConversions']['visit']['conversions'] }}/{{ $stats['thirdDownConversions']['visit']['attempts'] }}
                                        ({{ $stats['thirdDownConversions']['visit']['percentage'] }})%</td>
                                </tr>
                                <tr>
                                    <th>Fourth Down Conversions / Attempts</th>
                                    <td>{{ $stats['fourthDownConversions']['home']['conversions'] }}/{{ $stats['fourthDownConversions']['home']['attempts'] }}
                                        ({{ $stats['fourthDownConversions']['home']['percentage'] }}%)</td>
                                    <td>{{ $stats['fourthDownConversions']['visit']['conversions'] }}/{{ $stats['fourthDownConversions']['visit']['attempts'] }}
                                        ({{ $stats['fourthDownConversions']['visit']['percentage'] }})%</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5>Special Teams Play Type</h5>
            <a href="{{ route('plays.kickoff', $match) }}" class="waves-effect btn-flat btn-block">Kickoff</a>
            <a href="{{ route('plays.punt', $match) }}" class="waves-effect btn-flat btn-block">Punt</a>
            <a href="{{ route('plays.field-goal', $match) }}" class="waves-effect btn-flat btn-block">Field Goal</a>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        var element = document.getElementById("scroll");
        element.scrollTop = element.scrollHeight;
    </script>
@stop