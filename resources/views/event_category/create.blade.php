@extends('layouts.layout')

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">New Position</span>
                </div>
            </div>
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="category_name" name="category_name" type="text" class="@error('category_name') invalid @enderror"
                               value="{{ old('category_name') }}">
                        <label for="category_name">{{ __('Category Name') }}</label>
                        @error('category_name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="description" name="description" type="text" class="@error('description') invalid @enderror"
                               value="{{ old('description') }}">
                        <label for="description">{{ __('Description') }}</label>
                        @error('description')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror

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