@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <span class="card-title">Edit Player</span>
            {{ $player->user->name }}
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('players.update', $player) }}">
                @csrf
                @method('PUT')
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input disabled value="{{ $player->user->name }}" id="disabled" type="text">
                        <label for="disabled">Name</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <select id="position" name="position">
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ ($position->id==$player->position_id)?'selected':'' }}>{{ $position->position_name }}</option>
                        @endforeach
                    </select>
                    <label>Position</label>
                </div>
                <div class="input-field col s12">
                    <select id="team" name="team">
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" {{ ($team->id==$player->team_id)?'selected':'' }}>{{ $team->name }}</option>
                        @endforeach
                    </select>
                    <label>Team</label>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="shirt_number" name="shirt_number" type="number"
                               class="@error('shirt_number') invalid @enderror"
                               value="{{ $player->shirt_number }}">
                        <label for="shirt_number">{{ __('Shirt Number') }}</label>
                        @error('shirt_number')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="joined_at" name="joined_at" type="text"
                               class="datepicker @error('joined_at') invalid @enderror"
                               value="{{ $player->joined_at }}">
                        <label for="joined_at">{{ __('Joined At') }}</label>
                        @error('joined_at')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
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