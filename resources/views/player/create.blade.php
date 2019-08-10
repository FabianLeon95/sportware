@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">New Player</span>
                </div>
            </div>
            <a href="{{ route('player.create.user') }}">Create player from existing user</a>
            <form method="POST" action="{{ route('players.store') }}">
                @csrf
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="name" name="name" type="text" class="@error('name') invalid @enderror"
                               value="{{ old('name') }}">
                        <label for="name">{{ __('Name') }}</label>
                        @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="email" name="email" type="email" class="@error('email') invalid @enderror"
                               value="{{ old('email') }}">
                        <label for="email">{{ __('Email') }}</label>
                        @error('email')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="input-field col s12">
                    <select id="position" name="position">
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ ($position->id==1)?'selected':'' }}>{{ $position->position_name }}</option>
                        @endforeach
                    </select>
                    <label>Position</label>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="shirt_number" name="shirt_number" type="number"
                               class="@error('shirt_number') invalid @enderror"
                               value="{{ old('shirt_number') }}">
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
                               value="{{ old('joined_at') }}">
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