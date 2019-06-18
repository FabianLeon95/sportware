@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">New Rookie</span>
                </div>
            </div>
        </div>
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#from-user">From User</a></li>
                <li class="tab"><a class="active" href="#from-scratch">From Scratch</a></li>
            </ul>
        </div>
        <div class="card-content">
            <form id="from-user" method="POST" action="{{ route('rookies.store') }}">
                @csrf
                <div class="input-field col s12">
                    <select id="user" name="user">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ ($user->id==1)?'selected':'' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <label>User</label>
                </div>
                <div class="input-field col s12">
                    <select id="position" name="position">
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ ($position->id==1)?'selected':'' }}>{{ $position->position_name }}</option>
                        @endforeach
                    </select>
                    <label>Position</label>
                </div>

                <div class="input-field col s12 p-0">
                    <textarea id="observations" name="observations" class="materialize-textarea"></textarea>
                    <label>Observations</label>
                </div>

                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Save') }}
                    </button>
                </div>
            </form>

            <form id="from-scratch" method="POST" action="{{ route('rookies.store.user') }}">
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
                        <textarea id="observations" name="observations" class="materialize-textarea"></textarea>
                        <label>Observations</label>
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