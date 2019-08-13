@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Games</span>
                </div>
            </div>
            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Season</th>
                    <th>Match</th>
                    <th>Game type</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($matches as $match)
                    <tr>
                        <td>{{ $match->season->years }} {{ $match->season->description }}</td>
                        <td>{{ $match->homeTeam->name }} vs {{ $match->visitTeam->name }}</td>
                        <td>{{ str_replace("_", " ", ucwords($match->game_type, "_")) }}</td>
                        <td>{{ $match->date }}</td>
                        <td class="right-align">
                            <a href="{{ route('stats.show', $match->id) }}" class="btn waves-effect">
                                <i class="fas fa-clipboard-list"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {{ $matches->links('partials.pagination') }}
            </div>
        </div>
    </div>
@stop