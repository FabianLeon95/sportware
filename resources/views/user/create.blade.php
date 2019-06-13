@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">New User</span>
                </div>
            </div>
            <form method="POST" action="{{ route('users.store') }}">
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
                    <select id="role" name="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ ($role->id==3)?'selected':'' }}>{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                    <label>Role</label>
                </div>
                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@stop