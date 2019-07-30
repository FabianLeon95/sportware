@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Users</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('users.create') }}" class="btn waves-effect"><i class="material-icons">
                            person_add
                        </i>
                    </a>
                </div>
            </div>
            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->role_name }}</td>
                        <th class="right-align">
                            <a class="dropdown-trigger btn-icon btn-flat waves-effect" data-target='user{{$user->id}}'>
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul id='user{{$user->id}}' class='dropdown-content'>
                                <li>
                                    <a href="{{ route('users.edit', $user) }}"><i
                                                class="material-icons">edit</i>Edit</a>
                                </li>
                                <li>
                                    <a href="#delete-confirm-{{ $user->id }}" class="modal-trigger"><i
                                                class="material-icons">delete</i>Delete</a>
                                </li>
                            </ul>
                        </th>
                    </tr>

                    <div id="delete-confirm-{{ $user->id }}" class="modal">
                        <div class="modal-content">
                            <h4><i class="material-icons icon">warning</i>Warning</h4>
                            <p>The action to be performed needs confirmation</p>
                        </div>
                        <form action="{{ route('users.destroy', $user) }}" method="post">
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
                {{ $users->links('partials.pagination') }}
            </div>
        </div>
    </div>
@stop