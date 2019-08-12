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
                    <div class="card" style="background-color: #000060">
                        <div class="card-content white-text" style="padding: 1em">
                            <table style="border-collapse: inherit">
                                <tr>
                                    <td> {{ $match->date }}</td>
                                    <td>
                                        <p><b>Home:</b> {{ $match->homeTeam->name }}</p>
                                        <p><b>Visit:</b> {{ $match->visitTeam->name }}</p>
                                    </td>
                                    <td class="right-align">
                                        <a href="{{ route('plays.index', $match) }}" class="btn waves-effect">
                                            <i class="material-icons">
                                                navigate_next
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>

@stop