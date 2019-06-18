@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">New Position</span>
                </div>
            </div>
            <form method="POST" action="{{ route('positions.store') }}">
                @csrf
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="position_name" name="position_name" type="text" class="@error('position_name') invalid @enderror"
                               value="{{ old('position_name') }}">
                        <label for="position_name">{{ __('Name') }}</label>
                        @error('position_name')
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