@extends('layouts.layout')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
@stop

@section('content')
    <div class="row py-1">
        <div class="col s12">
            <div class="card">
                <div class="card-content blue-grey darken-4 white-text">
                    <div class="row">
                        <div class="col s6 center-align">
                            <h4>
                                @if ($play->team_id == $match->home_team_id)
                                    <i class="fas fa-football-ball"></i>
                                @endif
                                {{ $match->homeTeam->name }}
                            </h4>
                            <h4>{{ $score['home']}}</h4>
                        </div>
                        <div class="col s6 center-align">
                            <h4>
                                @if ($play->team_id == $match->visit_team_id)
                                    <i class="fas fa-football-ball"></i>
                                @endif
                                {{ $match->visitTeam->name }}
                            </h4>
                            <h4>{{ $score['visit'] }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s3 center-align">
                            Down: {{ $play->down }}
                        </div>
                        <div class="col s3 center-align">
                            To go: {{ $play->to_go }}
                        </div>
                        <div class="col s3 center-align">
                            Ball on: {{ $play->ball_on }}
                        </div>
                        <div class="col s3 center-align">
                            QTR: {{ $play->quarter }}
                        </div>
                    </div>
                </div>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a href="#event">Add Event</a></li>
                        <li class="tab"><a href="#plays">Plays</a></li>
                        <li class="tab"><a href="#stats">Stats</a></li>
                    </ul>
                </div>
                <div class="card-content grey lighten-4">
                    <div id="event">
                        <div class="row">
                            <div class="col s6 py-2">
                                <a href="#modal1" class="btn btn-big valign-wrapper modal-trigger">
                                    Special Teams
                                </a>
                            </div>
                            <div class="col s6 py-2">
                                <a href="{{ route('plays.penalty-bs', $match) }}" class="btn btn-big valign-wrapper">
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
                        </div>
                    </div>
                    <div id="plays">

                    </div>
                    <div id="stats">

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