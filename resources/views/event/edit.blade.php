@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s12 p-0">
                    <span class="card-title"><b>Edit Event</b> {{ $event->description }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('events.update', $event) }}">
                @csrf
                @method('PUT')
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="date" name="date" type="text"
                               class="datepicker @error('date') invalid @enderror"
                               value="{{ $event->date }}">
                        <label for="date">{{ __('Date') }}</label>
                        @error('date')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="time" name="time" type="text"
                               class="timepicker @error('time') invalid @enderror"
                               value="{{ $event->time }}">
                        <label for="time">{{ __('Time') }}</label>
                        @error('time')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="description" name="description" type="text" class="@error('description') invalid @enderror"
                               value="{{ $event->description }}">
                        <label for="description">{{ __('Description') }}</label>
                        @error('description')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="input-field col s12">
                    <select id="category" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ ($category->id==$event->event_category_id)?'selected':'' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <label>Category</label>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="location" name="location" type="text" class="@error('location') invalid @enderror"
                               value="{{ $event->location }}">
                        <label for="location">{{ __('Location') }}</label>
                        @error('location')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="input-field col s12 p-0">
                        <input id="observations" name="observations" type="text" class="@error('observations') invalid @enderror"
                               value="{{ $event->observations }}">
                        <label for="observations">{{ __('Observations') }}</label>
                        @error('observations')
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