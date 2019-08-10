@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <span class="card-title">Edit Report</span>
            {{ $report->patient->name }} | <span>{{ \Carbon\Carbon::parse($report->created_at)->toFormattedDateString() }}</span>

            <form method="POST" action="{{ route('reports.update', $report) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-0 mt-2">
                    <div class="input-field col s12 p-0">
                        <input id="visit_reason" name="visit_reason" type="text"
                               class="@error('visit_reason') invalid @enderror"
                               value="{{ $report->visit_reason }}">
                        <label for="shirt_number">{{ __('Visit Reason') }}</label>
                        @error('visit_reason')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="diagnostic" name="diagnostic" type="text"
                               class="@error('joined_at') invalid @enderror"
                               value="{{ $report->diagnostic }}">
                        <label for="diagnostic">{{ __('Diagnostic') }}</label>
                        @error('diagnostic')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="treatment" name="treatment" type="text"
                               class="@error('treatment') invalid @enderror"
                               value="{{ $report->treatment }}">
                        <label for="treatment">{{ __('Treatment') }}</label>
                        @error('treatment')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="observations" name="observations" type="text"
                               class="@error('observations') invalid @enderror"
                               value="{{ $report->observations }}">
                        <label for="observations">{{ __('Observations') }}</label>
                        @error('observations')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="file-field input-field">
                    <div class="btn waves-effect">
                        <span>File</span>
                        <input name="files[]" type="file" class="@error('files.*') invalid @enderror" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path" type="text" placeholder="Upload one or more files">
                    </div>
                    @error('files.*')
                    <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@stop