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
    <div class="card mt-2">
        <div class="card-content">
            <div class="row mb-0">
                <div class="input-field col s12 select-title">
                    <select id="selection">
                        <option value="1" selected>User Information</option>
                        <option value="2">Change Password</option>
                    </select>
                </div>
            </div>
            <form method="POST" action="{{ route('profile.info.update', $user) }}">
                @csrf
                <div class="row mb-0 mt-2">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="@error('name') invalid @enderror"
                               value="{{ $user->name }}">
                        <label for="name">{{ __('Name') }}</label>
                        @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0 mt-2">
                    <div class="input-field col s12">
                        <input id="email" name="email" type="email" class="@error('email') invalid @enderror"
                               value="{{ $user->email }}">
                        <label for="email">{{ __('Email') }}</label>
                        @error('email')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="birthdate" name="birthdate" type="text"
                               class="datepicker @error('birthdate') invalid @enderror"
                               value="{{ $user->birthdate }}">
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
                               value="{{ $user->nationality }}">
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
                                <option value="{{ $marital_status->id }}" {{ ($marital_status->id==$user->marital_status_id)?'selected':'' }}>{{ $marital_status->status }}</option>
                            @endforeach
                        </select>
                        <label for="marital_status">Marital Status</label>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12">
                        <input id="phone_number" name="phone_number" type="number"
                               class="@error('phone_number') invalid @enderror"
                               value="{{ $user->phone_number }}">
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