@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Seasons</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('seasons.create') }}" class="btn waves-effect"><i class="material-icons">
                            add
                        </i>
                    </a>
                </div>
            </div>
            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Year</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($seasons as $season)
                    <tr>
                        <td>{{ $season->year }}</td>
                        <td>{{ $season->description }}</td>
                        <td class="right-align">
                            <a class="dropdown-trigger btn-icon btn-flat waves-effect" data-target='season{{$season->id}}'>
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul id='season{{$season->id}}' class='dropdown-content'>
                                <li>
                                    <a href="{{ route('seasons.edit', $season) }}"><i
                                                class="material-icons">edit</i>Edit</a>
                                </li>
                                <li>
                                    <a href="#delete-confirm-{{ $season->id }}" class="modal-trigger"><i class="material-icons">delete</i>Delete</a>
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <div id="delete-confirm-{{ $season->id }}" class="modal">
                        <div class="modal-content">
                            <h4><i class="material-icons icon">warning</i>Warning</h4>
                            <p>The action to be performed needs confirmation</p>
                        </div>
                        <form action="{{ route('seasons.destroy', $season) }}" method="post">
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
                {{ $seasons->links('partials.pagination') }}
            </div>
        </div>
    </div>
@stop