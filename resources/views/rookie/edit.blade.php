@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Edit {{ $rookie->user->name }}</span>
                </div>
            </div>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('rookies.update', $rookie) }}">
                @csrf
                @method('PUT')
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input disabled id="name" name="name" type="text"
                               value="{{ $rookie->user->name }}">
                        <label for="name">{{ __('Name') }}</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <select id="position" name="position">
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ ($position->id==$rookie->position_id)?'selected':'' }}>{{ $position->position_name }}</option>
                        @endforeach
                    </select>
                    <label>Position</label>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <textarea id="observations" name="observations" class="materialize-textarea @error('observations') invalid @enderror">{{ $rookie->observations }}</textarea>
                        <label for="observations">Observations</label>
                        @error('observations')
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