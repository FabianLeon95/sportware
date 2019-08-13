@extends('layouts.layout')

@section('styles')
    <style>
        td, th {
            padding: 12px 8px;
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
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <p>{{ $match->season->years }} {{ $match->season->description }}</p>
                    <span class="card-title">{{ $match->homeTeam->name }} vs {{ $match->visitTeam->name }}</span>
                </div>
            </div>
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
@stop