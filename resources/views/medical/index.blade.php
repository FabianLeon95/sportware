@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6 p-0">
                    <span class="card-title">Search User</span>
                </div>
                <div class="col s6 p-0 right-align">
                    <a href="{{ route('users.create') }}" class="btn waves-effect"><i class="material-icons">
                            person_add
                        </i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="autocomplete-input" class="autocomplete">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.autocomplete');
            var instances = M.Autocomplete.init(elems, {
                data: {
                    @forEach($users as $user)
                        '{{ $user->name }}' : null,
                    @endforeach
                },
                onAutocomplete : function () {
                    var user = document.querySelector('.autocomplete').value;
                    window.location.href = '/medical/search/' + user;
                }
            });
        });
    </script>
@stop