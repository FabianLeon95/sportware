@extends('layouts.basic')

@section('content')
    <div class="card mt-2">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6">
                    <span class="card-title">Complete Registration</span>
                </div>
            </div>
            <form method="POST" action="{{ route('registration.update', $user) }}">
                @csrf
                <div class="row mb-0 mt-2">
                    <div class="input-field col s6">
                        <input id="first_name" name="first_name" type="text"
                               class="@error('first_name') invalid @enderror"
                               value="{{ old('first_name') }}">
                        <label for="first_name">{{ __('First Name') }}</label>
                        @error('first_name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" name="last_name" type="text" class="@error('last_name') invalid @enderror"
                               value="{{ old('last_name') }}">
                        <label for="last_name">{{ __('Last Name') }}</label>
                        @error('last_name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="password" name="password" type="password"
                               class="@error('password') invalid @enderror"
                               value="{{ old('password') }}">
                        <label for="password">{{ __('Password') }}</label>
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
                        <label for="password_confirmation">{{ __('Password Confirmation') }}</label>
                        @error('password_confirmation')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="birthdate" name="birthdate" type="text"
                               class="datepicker @error('birthdate') invalid @enderror"
                               value="{{ old('birthdate') }}">
                        <label for="birthdate">{{ __('Birthdate') }}</label>
                        @error('birthdate')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="nationality" name="nationality" type="text"
                               class="@error('nationality') invalid @enderror"
                               value="{{ old('nationality') }}">
                        <label for="nationality">{{ __('Nationality') }}</label>
                        @error('nationality')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <select id="marital_status" name="marital_status">
                            @foreach ($maritalStatuses as $marital_status)
                                <option value="{{ $marital_status->id }}" {{ ($marital_status->id==1)?'selected':'' }}>{{ $marital_status->status }}</option>
                            @endforeach
                        </select>
                        <label for="marital_status">Marital Status</label>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="phone_number" name="phone_number" type="number"
                               class="@error('phone_number') invalid @enderror"
                               value="{{ old('phone_number') }}">
                        <label for="phone_number">{{ __('Phone Number') }}</label>
                        @error('phone_number')
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
