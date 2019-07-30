@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Fumble</span>
                </div>
            </div>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('plays.fumble.create', $match) }}">
                @csrf
                <h5 class="mt-0">{{ $team->name }}</h5>
                <input type="hidden" name="team" value="{{ $team->id }}">
                <div class="input-field col s12 mt-5">
                    <select id="caused_by" name="caused_by">
                        <option value="-1">Select player...</option>
                        @foreach ($players as $player)
                            <option value="{{ $player->id }}">{{ $player->shirt_number }} {{ ($player->user) ? $player->user->name: '' }}</option>
                        @endforeach
                    </select>
                    <label for="caused_by">Caused by</label>
                </div>

                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')

@stop