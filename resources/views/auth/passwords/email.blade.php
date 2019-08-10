@extends('layouts.basic')

@section('content')

    @if (session('status'))
        <div class="card blue-text text-darken-2 blue lighten-5 mt-2" style="padding: 0.5em" role="alert">
            <i class="material-icons left">
                info
            </i>
            {{ session('status') }}
        </div>
    @endif

    <div class="card mt-2">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6">
                    <span class="card-title">Reset Password</span>
                </div>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="email" name="email" type="email" class="@error('email') invalid @enderror"
                               value="{{ old('email') }}">
                        <label for="email">{{ __('Email') }}</label>
                        @error('email')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block waves-effect mt-5">
                    {{ __('Send Password Reset Link') }}
                </button>

            </form>
        </div>
    </div>
@stop
