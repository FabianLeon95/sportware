@extends('layouts.layout')

@section('progress')
    <div class="progress mt-0" style="visibility: hidden">
        <div class="indeterminate"></div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Recovery</span>
                </div>
            </div>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('plays.recovery.create', $match) }}">
                @csrf
                <input type="hidden" name="return_type" value="kickoff">
                <input type="hidden" id="yards" name="yards" value="{{ $play->ball_on }}">
                <input type="hidden" id="ball_on" name="ball_on" value="{{ $play->ball_on }}">
                <input type="hidden" id="team" name="team" value="{{ $team->id }}">

                <h5 class="mt-0">{{ $team->name }}</h5>
                <div class="input-field col s12 mt-5">
                    <select id="recover" name="recover">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">#{{ $player->shirt_number }} {{ ($player->user) ? $player->user->name: '' }}</option>
                        @endforeach
                    </select>
                    <label for="recover">Recover</label>
                </div>

                <div class="row">
                    <div class="col s1">
                        {{ $play->left_team->name }}
                    </div>
                    <div class="col s10">
                        <div class="football-field">
                            <div id="yards-range" class="range-slider"></div>
                        </div>
                    </div>
                    <div class="col s1">
                        {{ $play->right_team->name }}
                    </div>
                </div>

                <div class="row mt-5 center-align">
                    <div class="col s4">
                        <label>
                            <input type="checkbox" name="specials[]" id="touch_down" value="touch_down"/>
                            <span>Touch Down</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="checkbox" name="specials[]" id="fumble"  value="fumble"/>
                            <span>Fumble</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="checkbox" name="specials[]" id="penalty" value="penalty"/>
                            <span>Penalty</span>
                        </label>
                    </div>
                </div>

                <div class="right-align">
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Next') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" href="/noUiSlider/nouislider.css">
@stop

@section('scripts')
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="/noUiSlider/nouislider.min.js"></script>
    <script src="/js/returnValidations.js"></script>
    <script>
        $(document).ready(function () {
            let slider = document.getElementById('yards-range');
            noUiSlider.create(slider, {
                start: {{ $play->ball_on }},
                connect: true,
                step: 1,
                orientation: 'horizontal', // 'horizontal' or 'vertical'
                range: {
                    'min': 0,
                    'max': 100
                },
                pips: {
                    mode: 'values',
                    values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                    density: 1
                },
                format: wNumb({
                    decimals: 0
                })
            });

            slider.noUiSlider.on('change', function () {
                $('#yards').val(slider.noUiSlider.get()-$('#ball_on').val());

                console.log($('#yards').val());

                if (slider.noUiSlider.get() == 100 || slider.noUiSlider.get() == 0){
                    $('#touch_down').prop( "checked", true );
                } else {
                    $('#touch_down').prop( "checked", false );
                }
            });
        });


    </script>
@stop