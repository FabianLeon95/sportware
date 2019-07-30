@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Edit Team</span>
                </div>
            </div>
            <form method="POST" action="{{ route('teams.update', $team) }}">
                @csrf
                @method('PUT')
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="name" name="name" type="text" class="@error('name') invalid @enderror"
                               value="{{ $team->name }}">
                        <label for="name">{{ __('Name') }}</label>
                        @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12 p-0">
                        <input id="location" name="location" type="text" class="@error('location') invalid @enderror"
                               value="{{ $team->location }}">
                        <label for="location">{{ __('Location') }}</label>
                        @error('location')
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