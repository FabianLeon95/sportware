@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Email Notifications</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('notification.create') }}" class="btn waves-effect"><i class="material-icons">
                            email
                        </i>
                    </a>
                </div>
            </div>
            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Subject</th>
                    <th>User</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{ $notification->subject }}</td>
                        <td>{{ $notification->user->name }}</td>
                        <td>{{ $notification->created_at }}</td>
                        <th class="right-align">
                            <a class="dropdown-trigger btn-icon btn-flat waves-effect" data-target='notification-{{$notification->id}}'>
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul id='notification-{{$notification->id}}' class='dropdown-content'>
                                <li>
                                    <a href="#show-{{ $notification->id }}" class="modal-trigger"><i class="material-icons">info</i>Details</a>
                                </li>
                            </ul>
                        </th>
                    </tr>

                    <div id="show-{{ $notification->id }}" class="modal">
                        <div class="modal-content">
                            <h5>{{ $notification->subject }}</h5>
                            <div class="row mt-2">
                                <div style="display: inline-block; margin-right: 2em">
                                    {{ $notification->user->name }}
                                    <i class="material-icons left">
                                        person
                                    </i>
                                </div>
                                <div style="display: inline-block; margin-right: 2em">
                                    {{ $notification->created_at }}
                                    <i class="material-icons left">
                                        schedule
                                    </i>
                                </div>
                            </div>
                            <p>{{ $notification->body }}</p>
                        </div>
                        <div class="modal-footer">
                            <a class="modal-close grey btn waves-effect">Close</a>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {{ $notifications->links('partials.pagination') }}
            </div>
        </div>
    </div>
@stop