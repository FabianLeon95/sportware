@extends('layouts.layout')

@section('styles')
    <style>
        .d-inline-block{
            display: inline-block!important;
        }
        .h4 {
            font-size: 2.25rem;
        }
    </style>
@stop

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 p-0">
                    <span class="h4">Create Medical Record</span>
                    <span class="card-title">{{ $user->name }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('record.store', $user) }}">
                @csrf
                <table>
                    <tbody>
                    <tr>
                        <th>Height:</th>
                        <td colspan="2" style="padding: 0 5px;">
                            <div class="input-field col s12" style="margin: 0">
                                <input id="height" name="height" type="number" step=".01"
                                       class="@error('height') invalid @enderror"
                                       value="{{ old('height') }}">
                                @error('height')
                                <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Weight:</th>
                        <td colspan="2" style="padding: 0 5px;">
                            <div class="input-field col s12" style="margin: 0">
                                <input id="weight" name="weight" type="number" step=".01"
                                       class="@error('weight') invalid @enderror"
                                       value="{{ old('weight') }}">
                                @error('weight')
                                <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    @foreach($columns as $column)
                        <tr>
                            <th>{{ str_replace("_", " ", ucwords($column, "_")) }}</th>
                            <td>
                                <label>
                                    <input name="{{ $column }}[]" type="checkbox" value="personal"/>
                                    <span>Personal</span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input name="{{ $column }}[]" type="checkbox" value="familiar"/>
                                    <span>Familiar</span>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Bruises</th>
                        <td>
                            <label>
                                <input name="bruises" type="radio" value="1"/>
                                <span>Yes</span>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="bruises" type="radio" value="0" checked/>
                                <span>No</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th>Fractures</th>
                        <td>
                            <label>
                                <input name="fractures" type="radio" value="1"/>
                                <span>Yes</span>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="fractures" type="radio" value="0" checked/>
                                <span>No</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th>Muscle Injuries</th>
                        <td>
                            <label>
                                <input name="muscle_injuries" type="radio" value="1"/>
                                <span>Yes</span>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="muscle_injuries" type="radio" value="0" checked/>
                                <span>No</span>
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th>Alcohol</th>
                        <td>
                            <label>
                                <input name="alcohol" type="radio" value="1"/>
                                <span>Yes</span>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="alcohol" type="radio" value="0" checked/>
                                <span>No</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th>Tobacco</th>
                        <td>
                            <label>
                                <input name="tobacco" type="radio" value="1"/>
                                <span>Yes</span>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="tobacco" type="radio" value="0" checked/>
                                <span>No</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th>Other:</th>
                        <td colspan="2" style="padding: 0 5px;">
                            <div class="input-field col s12" style="margin: 0">
                                <input id="other" name="other" type="text"
                                       class="@error('other') invalid @enderror"
                                       value="{{ old('other') }}">

                                @error('other')
                                <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-block waves-effect mt-5">Save</button>
            </form>
        </div>
    </div>
@stop