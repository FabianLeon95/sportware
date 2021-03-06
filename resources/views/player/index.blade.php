@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Players</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('players.create') }}" class="btn waves-effect"><i class="material-icons">
                            person_add
                        </i>
                    </a>
                </div>
            </div>
            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Team</th>
                    <th>Number</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($players as $player)
                    <tr>
                        <td>{{ $player->user->name }}</td>
                        <td>{{ $player->team->name }}</td>
                        <td>{{ $player->shirt_number }}</td>
                        <th class="right-align">
                            <a class="dropdown-trigger btn-icon btn-flat waves-effect" data-target='player{{$player->id}}'>
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul id='player{{$player->id}}' class='dropdown-content'>
                                <li>
                                    <a href="{{ route('players.edit', $player) }}"><i
                                                class="material-icons">edit</i>Edit</a>
                                </li>
                                <li>
                                    <a href="#delete-confirm-{{ $player->id }}" class="modal-trigger"><i class="material-icons">delete</i>Delete</a>
                                </li>
                            </ul>
                        </th>
                    </tr>

                    <div id="delete-confirm-{{ $player->id }}" class="modal">
                        <div class="modal-content">
                            <h4><i class="material-icons icon">warning</i>Warning</h4>
                            <p>The action to be performed needs confirmation</p>
                        </div>
                        <form action="{{ route('players.destroy', $player) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-footer">
                                <a class="modal-close grey btn waves-effect">Cancel</a>
                                <button type="submit" class="modal-close btn waves-effect">Agree</button>
                            </div>
                        </form>
                    </div>
                @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {{ $players->links('partials.pagination') }}
            </div>
        </div>
    </div>
@stop