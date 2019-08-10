@extends('layouts.layout')

@section('styles')
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
{{--    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />--}}

    <link href='fullcalendar-4.2.0/packages/core/main.css' rel='stylesheet' />
    <link href='fullcalendar-4.2.0/packages/daygrid/main.css' rel='stylesheet' />
    <link href='fullcalendar-4.2.0/packages/bootstrap/main.css' rel='stylesheet' />
@stop

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Calendar</span>
                </div>
                @if (Auth::user()->hasRoles('admin','stats'))
                    <div class="col s6 p-0 right-align">
                        <a href="{{ route('events.create') }}" class="btn waves-effect">
                            New Event
                            <i class="material-icons right">
                                event
                            </i>
                        </a>
                    </div>
                @endif
            </div>
            <div class="center-align mt-5 preloader">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id='calendar' class="mt-5"></div>
        </div>
    </div>

@stop

@section('scripts')
    <script src='fullcalendar-4.2.0/packages/core/main.js'></script>
    <script src='fullcalendar-4.2.0/packages/daygrid/main.js'></script>
    <script src='fullcalendar-4.2.0/packages/bootstrap/main.js'></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                dataType: 'text',
                url: 'https://sportware.test/events/all-events/1',
                // beforeSend: function () {
                //     //$('.progress').css("visibility", "visible");
                // },
                success: function (data) {
                    sources = [];
                    data = JSON.parse(data);
                    //console.log(data[0])
                    for( var i = 0; i < data.length; i++){
                        let object = {
                            color: data[i].color,
                            textColor: 'white',
                            events: getEvents(data[i].events)
                        };
                        sources.push(object);
                    }
                    console.log(sources);
                    SetCalendar(sources);
                },
                complete: function () {
                    $('.preloader').remove();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });

            function getEvents(events) {
                let array = [];
                for( var i = 0; i < events.length; i++){
                    let obj = {
                        title: events[i].description,
                        start: events[i].date+'T'+events[i].time,
                        url: '/events/'+ events[i].id
                    };
                    array.push(obj);
                }
                return array;
            }

            function SetCalendar(sources) {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['dayGrid', 'bootstrap'],
                    themeSystem: 'bootstrap',
                    eventSources: sources
                });
                calendar.render();
            }
        });

    </script>
@stop