@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">Point After</span>
                </div>
            </div>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('plays.point-after.create', $match) }}">
                @csrf
                <h5 class="mt-0">{{ $team->name }}</h5>
                <input type="hidden" name="team" value="{{ $team->id }}">
                <div class="row mt-5">
                    <div class="col s4">
                        <label>
                            <input name="type" type="radio" value="kick" checked/>
                            <span>Kick</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input name="type" type="radio" value="run"/>
                            <span>Run</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input name="type" type="radio" value="pass"/>
                            <span>Pass</span>
                        </label>
                    </div>
                </div>
                <div id="kick">
                    <div class="row ">
                        <div class="input-field col s12 mt-5">
                            <select id="kicker" name="kicker">
                                @foreach ($players as $player)
                                    <option value="{{ $player->id }}">#{{ $player->shirt_number }} {{ $player->user->name }}</option>
                                @endforeach
                            </select>
                            <label for="kicker">Kicker</label>
                        </div>
                    </div>
                </div>
                <div id="run" style="display: none">
                    <div class="row ">
                        <div class="input-field col s12 mt-5">
                            <select id="runner" name="runner">
                                @foreach ($players as $player)
                                    <option value="{{ $player->id }}">#{{ $player->shirt_number }} {{ $player->user->name }}</option>
                                @endforeach
                            </select>
                            <label for="runner">Runner</label>
                        </div>
                    </div>
                </div>

                <div id="pass" style="display: none">
                    <div class="row ">
                        <div class="input-field col s12 mt-5">
                            <select id="passer" name="passer">
                                @foreach ($players as $player)
                                    <option value="{{ $player->id }}">#{{ $player->shirt_number }} {{ $player->user->name }}</option>
                                @endforeach
                            </select>
                            <label for="passer">Passer</label>
                        </div>
                        <div class="input-field col s12 mt-5">
                            <select id="receiver" name="receiver">
                                @foreach ($players as $player)
                                    <option value="{{ $player->id }}">#{{ $player->shirt_number }} {{ $player->user->name }}</option>
                                @endforeach
                            </select>
                            <label for="receiver">Receiver</label>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col s6">
                        <label>
                            <input name="status" type="radio" value="good" checked/>
                            <span>Good</span>
                        </label>
                    </div>
                    <div class="col s6">
                        <label>
                            <input name="status" type="radio" value="no_good"/>
                            <span>No Good</span>
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

@section('scripts')
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script>
        $(function () {
            let kick = $('#kick');
            let run = $('#run');
            let pass = $('#pass');

            $('input[type=radio][name=type]').change(function () {
                switch (this.value) {
                    case 'kick':
                        kick.show();
                        run.hide();
                        pass.hide();
                        break;
                    case 'run':
                        kick.hide();
                        run.show();
                        pass.hide();
                        break;
                    case 'pass':
                        kick.hide();
                        run.hide();
                        pass.show();
                        break;
                }
            });
        });
    </script>
@stop