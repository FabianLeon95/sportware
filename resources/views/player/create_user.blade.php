@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">New Player</span>
                </div>
            </div>
            @if ($users->isEmpty())

                    <div class="card-content">
                        <span class="card-title red-text" style="font-size: 20px">
                            <i class="material-icons left">warning</i>
                            All users with the player role are already assigned a player.
                        </span>
                    </div>

                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-block waves-effect">
                            <i class="material-icons left">arrow_back</i>
                            Back
                        </a>

            @else
                <form method="POST" action="{{ route('player.store.user') }}">
                    @csrf
                    <div class="input-field col s12 mt-5">
                        <select id="user" name="user">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ ($user->id==1)?'selected':'' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <label for="user">User</label>
                    </div>
                    <div class="input-field col s12 mt-5">
                        <select id="position" name="position">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}" {{ ($position->id==1)?'selected':'' }}>{{ $position->position_name }}</option>
                            @endforeach
                        </select>
                        <label for="position">Position</label>
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
            @endif
        </div>
    </div>

@stop