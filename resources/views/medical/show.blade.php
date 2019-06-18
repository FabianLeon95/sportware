@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
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
        <div class="card-content grey lighten-4">
            <div id="reports">
                @if (!$reports->isEmpty())
                    @foreach($reports as $report)
                        <div class="card">
                            <div class="card-content">
                                <b>Medic</b> : {{ $report->medic->name }}
                                <b>Diagnostic</b> : {{ $report->diagnostic }}
                                <b>Date</b> : {{ $report->created_at }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="center-align">
                        <h6 class="grey-text">{{ $user->name }} has no reports</h6>
                    </div>
                @endif
            </div>
            <div id="record">
                @if ($user->medical_record)
                    @include('partials.medical_record')
                    <a href="{{ route('record.create', $user) }}" class="btn btn-block">Edit</a>
                @else
                    <div class="center-align">
                        <h6 class="grey-text" style="display: inline-block;margin-right: .5rem">{{ $user->name }} has no medical record</h6>
                        <a href="{{ route('record.create', $user) }}" class="btn">Create</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
@stop