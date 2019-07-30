@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Punt</span>
                </div>
            </div>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('plays.punt.create', $match) }}">
                @csrf
                <input type="hidden" id="yards" name="yards" value="0">
                <input type="hidden" id="ball_on" name="ball_on" value="{{ $play->ball_on }}">
                <input type="hidden" id="team" name="team" value="{{ $team->id }}">

                <h5 class="mt-0">{{ $team->name }}</h5>
                <div class="input-field col s12">
                    <select id="kicker" name="kicker">
                        @foreach ($players as $player)
                            <option value="{{ $player->id }}">{{ $player->user->name }}</option>
                        @endforeach
                    </select>
                    <label for="kicker">Kicker</label>
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
                            <input type="checkbox" name="specials[]" id="touchback" value="touchback"/>
                            <span>Touchback</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="checkbox" name="specials[]" value="penalty"/>
                            <span>Penalty</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="checkbox" name="specials[]" id="no_return" value="no_return"/>
                            <span>No Return</span>
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

            $('#ball_on').val(slider.noUiSlider.get());

            slider.noUiSlider.on('change', function () {
                $('#yards').val(slider.noUiSlider.get()-$('#ball_on').val());
                if (slider.noUiSlider.get() == 100 || slider.noUiSlider.get() == 0){
                    $('#touchback').prop( "checked", true );
                } else {
                    $('#touchback').prop( "checked", false );
                }
            });
        });


    </script>
@stop