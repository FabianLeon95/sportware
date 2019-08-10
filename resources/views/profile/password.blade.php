@extends('layouts.layout')

@section('styles')\
<style>
    .select-title > .select-wrapper input.select-dropdown {
        font-size: 24px!important;
        font-weight: 300!important;
    }

</style>

@stop

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
                <div class="input-field col s12 select-title">
                    <select id="selection">
                        <option value="1">User Information</option>
                        <option value="2" selected>Change Password</option>
                    </select>
                </div>
            </div>
            <form method="POST" action="{{ route('profile.password.update', $user) }}">
                @csrf
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="old_password" name="old_password" type="password"
                               class="@error('old_password') invalid @enderror"
                               value="{{ old('old_password') }}">
                        <label for="old_password">{{ __('Old Password') }}</label>
                        @error('old_password')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="password" name="password" type="password"
                               class="@error('password') invalid @enderror"
                               value="{{ old('password') }}">
                        <label for="password">{{ __('New Password') }}</label>
                        @error('password')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="@error('password_confirmation') invalid @enderror"
                               value="{{ old('password_confirmation') }}">
                        <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                        @error('password_confirmation')
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

@section('scripts')
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#selection').change(function () {
                switch ($(this).val()) {
                    case '1':
                        window.location.href = '{{ route('profile.info', $user) }}';
                        break;
                    case '2':
                        window.location.href = '{{ route('profile.password', $user) }}';
                        break;
                }
            })
        });
    </script>
@stop