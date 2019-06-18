@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">{{ $user->name }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('reports.store') }}">
                @csrf
                <input type="hidden" name="patient_id" value="{{$user->id}}">
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="visit_reason" name="visit_reason" type="text"
                               class="@error('visit_reason') invalid @enderror"
                               value="{{ old('visit_reason') }}">
                        <label for="visit_reason">{{ __('Reason of the Visit') }}</label>
                        @error('visit_reason')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <textarea id="diagnostic" name="diagnostic" class="materialize-textarea"></textarea>
                        <label>Diagnostic</label>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <textarea id="treatment" name="treatment" class="materialize-textarea"></textarea>
                        <label>Treatment</label>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <textarea id="observations" name="observations" class="materialize-textarea"></textarea>
                        <label>Observations</label>
                    </div>
                </div>
                <div class="file-field input-field">
                    <div class="btn waves-effect">
                        <span>File</span>
                        <input type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path" type="text" placeholder="Upload one or more files">
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