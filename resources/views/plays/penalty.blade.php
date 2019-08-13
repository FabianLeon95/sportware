@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Penalty</span>
                </div>
            </div>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('plays.penalty.create', $match) }}">
                @csrf
                <h6>{{ $match->homeTeam->name }}</h6>
                <div class="input-field col s12">
                    <select id="home_foul" name="home_foul">
                        <option value="-1" selected>Select a penalty...</option>
                        @foreach ($fouls as $foul)
                            <option value="{{ $foul->id }}">{{ $foul->distance }} | {{ $foul->description }}</option>
                        @endforeach
                    </select>
                </div>

                <h6 class="mt-5">{{ $match->visitTeam->name }}</h6>
                <div class="input-field col s12">
                    <select id="visit_foul" name="visit_foul">
                        <option value="-1" selected>Select a penalty...</option>
                        @foreach ($fouls as $foul)
                            <option value="{{ $foul->id }}">{{ $foul->distance }} | {{ $foul->description }}</option>
                        @endforeach
                    </select>
                </div>

{{--                <div class="row mt-5">--}}
{{--                    <div class="col s4">--}}
{{--                        <label>--}}
{{--                            <input name="status" type="radio" value="1" checked />--}}
{{--                            <span>Override</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <div class="col s4">--}}
{{--                        <label>--}}
{{--                            <input name="status" type="radio" value="2" />--}}
{{--                            <span>Declined</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <div class="col s4">--}}
{{--                        <label>--}}
{{--                            <input name="status" type="radio" value="3" />--}}
{{--                            <span>Offsetting</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')

@stop