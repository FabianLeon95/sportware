@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">{{ $user->name }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('reports.store') }}">
                @csrf
                <table class="responsive-table">
                    <tbody>
                    @foreach($columns as $column)
                        <tr>
                            <th>{{ $column }}</th>
                            <td>
                                <label>
                                    <input name="{{ $column }}" type="radio" value="0" checked/>
                                    <span>Ninguna</span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input name="{{ $column }}" type="radio" value="1"/>
                                    <span>Familiar</span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input name="{{ $column }}" type="radio" value="2"/>
                                    <span>Personal</span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input name="{{ $column }}" type="radio" value="3"/>
                                    <span>Ambas</span>
                                </label>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </form>
        </div>
    </div>
@stop