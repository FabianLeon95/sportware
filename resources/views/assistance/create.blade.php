@extends('layouts.layout')

@section('styles')
    <style>
        .custom-badge {
            border-radius: 2px;
            color: white;
            padding: 0.2em 0.5em;
            background-color: {{$event->eventCategory->color}};
        }

        .with-badge {
            margin-right: 0.75em !important;
            display: inline-block !important;
            font-size: 28px !important;
        }
    </style>
@stop

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s10 p-0">
                    <span class="card-title with-badge"><b>{{ $event->description }}</b></span>
                    <span class="custom-badge">{{ $event->eventCategory->category_name }}</span>
                </div>
            </div>
            <span class="card-title mt-5">Assistance</span>
            <form action="{{ route('assistance.update', $event) }}" method="post" class="mt-2">
                @csrf
                <div class="row">
                    @foreach ($players as $player)
                        <div class="col s6">
                            <label>
                                <input type="checkbox" name="assistance[]" value="{{ $player->id }}" {{ $event->playersWhoAttended->contains($player) ? 'checked' : '' }}/>
                                <span>{{ $player->user->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-block waves-effect mt-2">Save</button>
            </form>
        </div>
    </div>
@stop