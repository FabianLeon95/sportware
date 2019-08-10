@extends('layouts.layout')

@section('styles')
    <style>
        [type=checkbox] + span:not(.lever) {
            padding-left: 25px!important;
        }
    </style>
@stop

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">New Notification</span>
                </div>
            </div>
            <form method="POST" action="{{ route('notification.store') }}">
                @csrf
                <div class="row mb-0">
                    <span class="mr-2">
                        <label>
                            <input type="checkbox" name="recipients[]" value="1"/>
                            <span>Admins</span>
                        </label>
                    </span>
                    <span  class="mr-2">
                        <label>
                            <input type="checkbox" name="recipients[]" value="2"/>
                            <span>Stats</span>
                        </label>
                    </span>
                    <span  class="mr-2">
                        <label>
                            <input type="checkbox" name="recipients[]" value="4"/>
                            <span>Medics</span>
                        </label>
                    </span>
                    <span  class="mr-2">
                        <label>
                            <input type="checkbox" name="recipients[]" value="3"/>
                            <span>Players</span>
                        </label>
                    </span>
                    <span  class="mr-2">
                        <label>
                            <input type="checkbox" name="recipients[]" value="5"/>
                            <span>Rookies</span>
                        </label>
                    </span>
                </div>
                @error('recipients')
                <span class="helper-text red-text" style="font-size: 12px">{{ $message }}</span>
                @enderror
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="subject" name="subject" type="text" class="@error('subject') invalid @enderror"
                               value="{{ old('subject') }}">
                        <label for="subject">{{ __('Subject') }}</label>
                        @error('subject')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <textarea id="message" name="message"
                                  class="materialize-textarea @error('message') invalid @enderror">{{ old('message') }}</textarea>
                        <label for="message">Message</label>
                        @error('message')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Send') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop