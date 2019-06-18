@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Rookies</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('rookies.create') }}" class="btn waves-effect"><i class="material-icons">
                            person_add
                        </i>
                    </a>
                </div>
            </div>
            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($rookies as $rookie)
                    <tr>
                        <td>{{ $rookie->user->name }}</td>
                        <td>{{ $rookie->position->position_name }}</td>
                        <th class="right-align">
                            <a class="dropdown-trigger btn-icon btn-flat waves-effect" data-target='rookie{{$rookie->id}}'>
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul id='rookie{{$rookie->id}}' class='dropdown-content'>
                                <li>
                                    <a href="{{ route('rookies.edit', $rookie) }}"><i
                                                class="material-icons">edit</i>Edit</a>
                                </li>
                                <li>
                                    <a href="#delete-confirm-{{ $rookie->id }}" class="modal-trigger"><i class="material-icons">delete</i>Delete</a>
                                </li>
                            </ul>
                        </th>
                    </tr>

                    <div id="delete-confirm-{{ $rookie->id }}" class="modal">
                        <div class="modal-content">
                            <h4><i class="material-icons icon">warning</i>Warning</h4>
                            <p>The action to be performed needs confirmation</p>
                        </div>
                        <form action="{{ route('rookies.destroy', $rookie) }}" method="post">
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
        </div>
    </div>
@stop