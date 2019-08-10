@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">{{ $user->name }}</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('reports.create', $user) }}"
                       class="btn waves-effect modal-trigger">
                        Create Report
                    </a>
                </div>
            </div>
        </div>
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a class="active" href="#reports">Reports</a></li>
                <li class="tab"><a href="#record">Medical Record</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-2">
            <div id="reports">
                @if (!$reports->isEmpty())
                    <div class="card">
                        <div class="card-content">
                            <table>
                                <thead>
                                <tr>
                                    <th>Diagnostic</th>
                                    <th>Medic</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ Illuminate\Support\Str::limit($report->diagnostic, 40) }}</td>
                                        <td>{{ $report->medic->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($report->created_at)->toFormattedDateString() }}</td>
                                        <td class="right-align">
                                            <a class="dropdown-trigger btn-icon btn-flat waves-effect" data-target='player{{$report->id}}'>
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul id='player{{$report->id}}' class='dropdown-content'>
                                                <li>
                                                    <a href="{{ route('reports.show', $report) }}"><i
                                                                class="material-icons">info</i>Details</a>
                                                    <a href="{{ route('reports.edit', $report) }}"><i
                                                                class="material-icons">edit</i>Edit</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="center-align">
                                {{ $reports->links('partials.pagination') }}
                            </div>
                        </div>
                    </div>

                @else
                    <div class="center-align">
                        <h6 class="grey-text">{{ $user->name }} has no reports</h6>
                    </div>
                @endif
            </div>
            <div id="record" class="card p-2">
                @if ($user->medicalRecord)
                    <div class="right-align">
                        <a href="{{ route('record.edit', $user) }}" class="btn waves-effect">
                            <i class="material-icons">
                                edit
                            </i>
                        </a>
                    </div>
                    @include('partials.medical_record', ['record'=>$user->medicalRecord])
                @else
                    <div class="center-align">
                        <h6 class="grey-text" style="display: inline-block;margin-right: .5rem">{{ $user->name }} has no
                            medical record</h6>
                        <a href="{{ route('record.create', $user) }}" class="btn">Create</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
@stop