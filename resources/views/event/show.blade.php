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

    <nav>
        <div class="right-align">
            <div class="col s12" style="margin: 0 1em">
                <a href="{{ route('events.index') }}" class="breadcrumb">Calendar</a>
                <a class="breadcrumb">Event</a>
            </div>
        </div>
    </nav>
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s10 p-0">
                    <span class="card-title with-badge">{{ $event->description }}</span>
                    <span class="custom-badge">{{ $event->eventCategory->category_name }}</span>
                </div>
                @if (Auth::user()->hasRoles('admin','stats','medic'))
                    <div class="col s2 p-0 right-align">
                        <a class="dropdown-trigger btn btn-floating waves-effect" data-target='player{{$event->id}}'>
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul id='player{{$event->id}}' class='dropdown-content'>
                            <li>
                                <a href="{{ route('events.edit', $event) }}"><i
                                            class="material-icons">edit</i>Edit</a>
                            </li>
                            <li>
                                <a href="#delete-confirm-{{ $event->id }}" class="modal-trigger"><i
                                            class="material-icons">delete</i>Delete</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
            @if (Auth::user()->hasRoles('admin','stats','medic'))
                <div id="delete-confirm-{{ $event->id }}" class="modal">
                    <div class="modal-content">
                        <h4><i class="material-icons icon">warning</i>Warning</h4>
                        <p>The action to be performed needs confirmation</p>
                    </div>
                    <form action="{{ route('events.destroy', $event) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <a class="modal-close grey btn waves-effect">Cancel</a>
                            <button type="submit" class="modal-close btn waves-effect">Agree</button>
                        </div>
                    </form>
                </div>
            @endif
            <div class="row mt-2">
                <div style="display: inline-block; margin-right: 2em">
                    {{ $event->date }}
                    <i class="material-icons left">
                        event
                    </i>
                </div>
                <div style="display: inline-block; margin-right: 2em">
                    {{ $event->time }}
                    <i class="material-icons left">
                        schedule
                    </i>
                </div>
                <div style="display: inline-block">
                    {{ $event->location }}
                    <i class="material-icons left">
                        place
                    </i>
                </div>
            </div>
            @if ($event->observations)
                <div class="row">
                    <span class="card-title">Observations:</span>
                    <p style="margin-top: 10px">{{ $event->observations }}</p>
                </div>
            @endif
            @if (Auth::user()->hasRoles('admin','stats','medic'))
                @if (!$event->playersWhoAttended->isEmpty())
                    <div class="row">
                        <span class="card-title" style="display: inline-block">Assistance:</span>
                        <span class="right-align" style="float: right">
                        <a href="{{ route('assistance.create', $event) }}" class="btn btn-flat waves-effect"><i
                                    class="material-icons left">
                                edit
                            </i>
                        Edit assistance
                        </a>
                    </span>

                        <table class="col s12">
                            <tbody>
                            @foreach ($event->playersWhoAttended as $player)
                                <tr>
                                    <td>
                                        <i class="material-icons left">
                                            check
                                        </i>
                                        {{ $player->user->name }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <a href="{{ route('assistance.create', $event) }}" class="btn waves-effect"><i
                                class="material-icons left">
                            assignment_ind
                        </i>
                        Check assistance
                    </a>
                @endif
            @endif
        </div>
    </div>
@stop