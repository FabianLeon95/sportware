@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Report</span>
                    <p>{{ $report->patient->name }}</p>
                    <p>{{ $report->created_at }}</p>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('reports.edit', $report) }}"
                       class="btn waves-effect"><i class="material-icons">edit</i>
                    </a>
                </div>
            </div>
            <h5>Visit Reason</h5>
            <p>{{ $report->visit_reason }}</p>
            <h5>Diagnostic</h5>
            <p>{{ $report->diagnostic }}</p>
            <h5>Treatment</h5>
            <p>{{ $report->treatment }}</p>
            <h5>Observations</h5>
            <p>{{ $report->observations }}</p>
        </div>
    </div>
@stop