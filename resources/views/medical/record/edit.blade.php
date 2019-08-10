@extends('layouts.layout')

@section('styles')
    <style>
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
                    <span class="h4">Edit Medical Record</span>
                    <span class="card-title">{{ $user->name }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('record.update', $user) }}">
                @csrf
                <table>
                    <tbody>
                    <tr>
                        <th>Height:</th>
                        <td colspan="2" style="padding: 0 5px;">
                            <div class="input-field col s12" style="margin: 0">
                                <input id="height" name="height" type="number" step=".01"
                                       class="@error('height') invalid @enderror"
                                       value="{{ $user->medicalRecord->height }}">
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
                                       value="{{ $user->medicalRecord->weight }}">
                                @error('weight')
                                <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Diabetes</th>
                        @include('partials.components.edit_checkbox', [
                            'array' => json_decode($user->medicalRecord->diabetes),
                            'column' => 'diabetes'
                        ])
                    </tr>
                    <tr>
                        <th>Hypertension</th>
                        @include('partials.components.edit_checkbox', [
                            'array' => json_decode($user->medicalRecord->hypertension),
                            'column' => 'hypertension'
                        ])
                    </tr>
                    <tr>
                        <th>Dyslipidemias</th>
                        @include('partials.components.edit_checkbox', [
                            'array' => json_decode($user->medicalRecord->dyslipidemias),
                            'column' => 'dyslipidemias'
                        ])
                    </tr>
                    <tr>
                        <th>Cancer</th>
                        @include('partials.components.edit_checkbox', [
                            'array' => json_decode($user->medicalRecord->cancer),
                            'column' => 'cancer'
                        ])
                    </tr>
                    <tr>
                        <th>Cardiovascular</th>
                        @include('partials.components.edit_checkbox', [
                            'array' => json_decode($user->medicalRecord->cardiovascular),
                            'column' => 'cardiovascular'
                        ])
                    </tr>
                    <tr>
                        <th>Neurological</th>
                        @include('partials.components.edit_checkbox', [
                            'array' => json_decode($user->medicalRecord->neurological),
                            'column' => 'neurological'
                        ])
                    </tr>
                    <tr>
                        <th>Bruises</th>
                        @include('partials.components.edit_radio', [
                            'value' => $user->medicalRecord->bruises,
                            'column' => 'bruises'
                        ])
                    </tr>
                    <tr>
                        <th>Fractures</th>
                        @include('partials.components.edit_radio', [
                            'value' => $user->medicalRecord->fractures,
                            'column' => 'fractures'
                        ])
                    </tr>
                    <tr>
                        <th>Muscle Injuries</th>
                        @include('partials.components.edit_radio', [
                            'value' => $user->medicalRecord->muscle_injuries,
                            'column' => 'muscle_injuries'
                        ])
                    </tr>

                    <tr>
                        <th>Alcohol</th>
                        @include('partials.components.edit_radio', [
                            'value' => $user->medicalRecord->tobacco,
                            'column' => 'tobacco'
                        ])
                    </tr>
                    <tr>
                        <th>Tobacco</th>
                        @include('partials.components.edit_radio', [
                            'value' => $user->medicalRecord->tobacco,
                            'column' => 'tobacco'
                        ])
                    </tr>
                    <tr>
                        <th>Other:</th>
                        <td colspan="2" style="padding: 0 5px;">
                            <div class="input-field col s12" style="margin: 0">
                                <input id="other" name="other" type="text"
                                       class="@error('other') invalid @enderror"
                                       value="{{ $user->medicalRecord->other }}">
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