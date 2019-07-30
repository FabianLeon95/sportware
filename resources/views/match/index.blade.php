@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Season</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('seasons.create') }}" class="btn waves-effect"><i class="material-icons">
                            add
                        </i>
                    </a>
                </div>
            </div>
            <form method="POST" action="{{ route('match.season') }}">
                @csrf
                @if(!$seasons->isEmpty())
                    <div class="input-field col s10">
                        <select id="season" name="season">
                            @foreach ($seasons as $season)
                                <option value="{{ $season->id }}" {{ ($season->id==1)?'selected':'' }}>{{ $season->year }} {{ $season->description }}</option>
                            @endforeach
                        </select>
                        <label>Season</label>
                    </div>
                    <div class="right-align">
                        <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Next') }}
                        </button>
                    </div>
                @else
                    <a href="{{ route('seasons.create') }}">Create a new season </a>
                @endif
            </form>
        </div>
    </div>
@stop