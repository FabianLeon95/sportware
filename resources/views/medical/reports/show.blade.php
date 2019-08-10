@extends('layouts.layout')

@section('styles')
    <style>
        .img-attach {
            width: 100%;
            max-width: 48px !important;
        }

        .zone {
            border-radius: 5px;
        }

        .thin {
            font-size: 20px;
            font-weight: 300;
        }
    </style>
@stop

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s9 p-0">
                    <span class="card-title"><b>Report</b></span>
                    <span>{{ $report->patient->name }}</span> |
                    <span>{{ \Carbon\Carbon::parse($report->created_at)->toFormattedDateString() }}</span>
                </div>
                <div class="col s3 p-0 right-align">
                    <a href="{{ route('reports.edit', $report) }}"
                       class="btn waves-effect"><i class="material-icons">edit</i>
                    </a>
                </div>
            </div>
            <h5 class="thin">Visit Reason</h5>
            <p>{{ $report->visit_reason }}</p>
            <h5 class="thin">Diagnostic</h5>
            <p>{{ $report->diagnostic }}</p>
            <h5 class="thin">Treatment</h5>
            <p>{{ $report->treatment }}</p>
            @if ($report->observations)
                <h5 class="thin">Observations</h5>
                <p>{{ $report->observations }}</p>
            @endif
            <h5 class="thin">Attachments</h5>
            <div class="row mt-2 grey zone lighten-2 p-2">
                @foreach($attachments as $attachment)
                    <div class="col s6 m4 center-align">
                        <a href="/{{ $attachment['path'] }}" download>
                            @if (Illuminate\Support\Str::contains($attachment['extension'], ['jpg','jpeg','png']))
                                <img class="responsive-img img-attach" src="/{{ $attachment['path'] }}" alt="Image">
                                <br>
                                {{ Illuminate\Support\Str::limit($attachment['name'], 15) }}
                            @elseif(Illuminate\Support\Str::contains($attachment['extension'], ['doc','docx']))
                                <i class="fas fa-file-word mb-2 blue-text text-darken-1" style="font-size: 32px"></i>
                                <br>
                                {{ Illuminate\Support\Str::limit($attachment['name'], 15) }}
                            @elseif(Illuminate\Support\Str::contains($attachment['extension'], ['pdf']))
                                <i class="fas fa-file-pdf mb-2 red-text text-darken-1" style="font-size: 32px"></i>
                                <br>
                                {{ Illuminate\Support\Str::limit($attachment['name'], 15) }}
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop