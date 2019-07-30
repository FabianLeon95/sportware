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
                    <span class="card-title">Kick Off</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('plays.swap') }}" class="btn waves-effect"><i class="material-icons left">
                            swap_horiz
                        </i>
                        Swap Teams
                    </a>
                </div>
            </div>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('plays.kick', $match) }}">
                @csrf
                <input type="hidden" name="kickoff" value="true">
                <input type="hidden" id="yards" name="yards" value="0">
                <input type="hidden" id="ball_on" name="ball_on" value="{{ $play->ball_on }}">
                <div class="input-field col s12">
                    <select id="team" name="team">
                        <option value="{{ $match->homeTeam->id }}" {{ ($match->homeTeam->id == $play->team_id) ? 'selected' : '' }}>{{ $match->homeTeam->name }}</option>
                        <option value="{{ $match->visitTeam->id }}" {{ ($match->visitTeam->id == $play->team_id) ? 'selected' : '' }}>{{ $match->visitTeam->name }}</option>
                    </select>
                    <label for="team">Team</label>
                </div>

                <div class="input-field col s12">
                    <select id="kicker" name="kicker">
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
                    <button class="btn btn-primary btn-block waves-effect mt-5" type="submit">{{ __('Save') }}
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
    <script src="/js/ajax.js"></script>
    <script>
        $(document).ready(function () {
            let slider = document.getElementById('yards-range');
            noUiSlider.create(slider, {
                start: 0,
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

            const team = $('select[name="team"]');

            kickoffYardLine(team, slider);

            $('#ball_on').val(slider.noUiSlider.get());


            slider.noUiSlider.on('change', function () {
                $('#yards').val(slider.noUiSlider.get()-$('#ball_on').val());
                if (slider.noUiSlider.get() == 100 || slider.noUiSlider.get() == 0){
                    $('#touchback').prop( "checked", true );
                } else {
                    $('#touchback').prop( "checked", false );
                }
            });

            load(team.val());

            team.on('change', function () {
                var teamId = $(this).val();
                if (teamId) {
                    kickoffYardLine(team, slider);
                    $('#ball_on').val(slider.noUiSlider.get());
                    load(teamId);
                } else {
                    $('select[name="kicker"]').empty();
                }

            });

        });


    </script>
@stop