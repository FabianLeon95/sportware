@extends('layouts.layout')

@section('styles')
    <style>
        .btn-color:focus {
            outline: none;
            background-color: white;
        }
        .btn-color {
            -webkit-appearance: button;
            outline: none;
            text-decoration: none;
            color: #000;
            background-color: white;
            text-align: center;
            letter-spacing: 0.5px;
            transition: background-color 0.2s ease-out;
            cursor: pointer;
            font-size: 14px;
            outline: 0;
            border: none;
            border-radius: 2px;
            display: inline-block;
            height: 36px;
            line-height: 36px;
            padding: 0 16px;
            text-transform: uppercase;
            vertical-align: middle;
            -webkit-tap-highlight-color: transparent;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            margin: 0;
            overflow: visible;
        }
    </style>
@stop

@section('content')

    <div class="card">
        <div class="card-content">
            <div class="row mb-0">
                <div class="col s6 p-0">
                    <span class="card-title">New Category</span>
                </div>
            </div>
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="row mb-0">
                    <div class="input-field col s9 p-0">
                        <input id="category_name" name="category_name" type="text" class="@error('category_name') invalid @enderror"
                               value="{{ old('category_name') }}">
                        <label for="category_name">{{ __('Category Name') }}</label>
                        @error('category_name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                        @error('color')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s3 center-align p-0">
                        <button type="button" class="btn-color">Color</button>
                        <input class="hide" id="color" type="color" value="#ff0000">
                        <input type="hidden" name="color" value="#fff">
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

@section('scripts')
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script>
        $(function() {
            function idealTextColor(bgColor) {
                var nThreshold = 105;
                var components = getRGBComponents(bgColor);
                var bgDelta = (components.R * 0.299) + (components.G * 0.587) + (components.B * 0.114);
                return ((255 - bgDelta) < nThreshold) ? "#000000" : "#ffffff";
            }

            function getRGBComponents(color) {
                var r = color.substring(1, 3);
                var g = color.substring(3, 5);
                var b = color.substring(5, 7);
                return {
                    R: parseInt(r, 16),
                    G: parseInt(g, 16),
                    B: parseInt(b, 16)
                };
            }

            $('.btn-color').on('click', function () {
                $('#color').focus();
                $('#color').click();
            });
            $('#color').change(function () {
                let color = $(this).val();
                $('.btn-color').css("background-color", color);
                $('.btn-color').css("color", idealTextColor(color));

                $('[name="color"]').val(color);
            });
        });



    </script>
@stop