@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Matches</span>
                    <a href="{{ route('match.index') }}"><h6>{{ $season->year }} {{ $season->description }}</h6></a>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('match.create', $season) }}" class="btn waves-effect"><i class="material-icons">
                            add
                        </i>
                    </a>
                </div>
            </div>
            @if ($matches->isEmpty())
                No matches found, create a new one.
            @else
                @foreach ($matches as $match)
                    <div class="card blue darken-1">
                        <div class="card-content text-white" style="padding: 1em">
                            <div class="row mb-0">
                                <div class="col s2">
                                    {{ $match->date }}
                                </div>
                                <div class="col s8">
                                    <p>Home: {{ $match->homeTeam->name }}</p>
                                    <p>Visit: {{ $match->visitTeam->name }}</p>
                                </div>
                                <div class="col s2">
                                    <a href="{{ route('plays.index', $match) }}" class="btn waves-effect"><i class="material-icons">
                                            navigate_next
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>

@stop