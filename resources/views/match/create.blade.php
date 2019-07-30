@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Create Game</span>
                </div>
            </div>
        </div>
        <div class="card-content mt-0">
            <form method="POST" action="{{ route('match.store', $season) }}">
                @csrf
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <select id="opponent" name="opponent">
                            @foreach ($opponents as $opponent)
                                <option value="{{ $opponent->id }}" {{ ($opponent->id==1)?'selected':'' }}>{{ $opponent->name }}</option>
                            @endforeach
                        </select>
                        <label>Opposing Team</label>
                        <a href="{{ route('teams.create') }}">Create new opponent</a>
                    </div>
                </div>
                <div class="row mb-0 mt-2">
                    <div class="col s3">
                        <label>
                            <input name="game_location" type="radio" value="home" checked />
                            <span>Home</span>
                        </label>
                    </div>
                    <div class="col s3">
                        <label>
                            <input name="game_location" type="radio" value="visit"/>
                            <span>Visit</span>
                        </label>
                    </div>
                </div>
                <div class="row mb-0 mt-5">
                    <div class="input-field col s12">
                        <input id="date" name="date" type="text"
                               class="datepicker @error('date') invalid @enderror"
                               value="{{ old('date') }}">
                        <label for="date">{{ __('Date') }}</label>
                        @error('date')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <select id="type" name="type">
                            <option value="scrimmage">Scrimmage</option>
                            <option value="regular_season" selected>Regular Season</option>
                            <option value="postseason">Postseason</option>
                        </select>
                        <label for="type">Game type</label>
                    </div>
                </div>
                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@stop