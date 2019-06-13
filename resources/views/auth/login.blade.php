<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sportware') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="dashboard">

<div class="container">
    <div class="row">
        <div class="login z-depth-2 white">
            <h4 class="center-align">{{ __('Login') }}</h4>
            <form method="POST" action="{{ route('login') }}">
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
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="password" name="password" type="password"
                               class="@error('password') invalid @enderror">
                        <label for="password">{{ __('Password') }}</label>
                        @error('password')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col s6">
                        <label>
                            <input type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}/>
                            <span>{{ __('Remember Me') }}</span>
                        </label>
                    </div>
{{--                    @if (Route::has('password.request'))--}}
                        <div class="col s6 right-align">
                            <a href="{{ route('password.request') }}" class="">{{ __('Forgot Password?') }}</a>
                        </div>
{{--                    @endif--}}

                </div>

                <button class="btn btn-primary btn-login waves-effect" type="submit">{{ __('Login') }}
                </button>
            </form>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>