@extends('layouts.app')

@section('content')
    <div class="col-6" id="addTpForm">
        <form method="POST">
            @csrf
            <label for="firstname">{{ __('Firstname') }}:</label>
            <input type="text" id="firstname" name="firstname" class="form-control"
                value="{{ old('firstname', 'tesztfirstname') }}">
            <label for="lastname">{{ __('Lastname') }}:</label>
            <input type="text" id="lastname" name="lastname" class="form-control"
                value="{{ old('lastname', 'tesztlastname') }}">
            <label for="zip">{{ __('ZIP') }}:</label>
            <input type="text" id="zip" name="zip" class="form-control" value="{{ old('zip', '1234') }}">
            <label for="city">{{ __('City') }}:</label>
            <input type="text" id="city" name="city" class="form-control" value="{{ old('city', 'tesztcity') }}">
            <label for="trade">{{ __('Trade') }}:</label>
            <div id="dynamicAdd">
                <div class="input-group">
                    <input type="text" id="trade" name="trade" class="form-control"
                        value="{{ old('trade', 'teszttrade') }}">
                    <div class="input-group-prepend" id="teszt">
                        <button type="button" name="addTrade" id="addTrade" class="btn btn-outline-primary">+</button>
                        <button type="button" name="removeTrade" id="removeTrade" class="btn btn-outline-danger">-</button>
                    </div>
                </div>
            </div>
            <label for="introduction">{{ __('Introduction') }}:</label>
            <textarea id="introduction" name="introduction" class="form-control"
                value="{{ old('introduction', 'Tesztintroduction') }}">
            </textarea>
            <label for="profilePic">{{ __("Profile picture:" )}}</label>
            <input type="file" id="profilePic" name="profilePic" class="form-control">
            <label for="references">{{ __('References') }}:</label>
            <input type="file" id="picreferencestures" name="references[]" class="form-control" multiple>
            <div id="highlighted">
                <label for="highlighted">{{ __('Highlighted person') }}:</label>
                <input type="checkbox" id="highlighted" name="highlighted" class="form-check-input">
            </div>
            <button type="submit" class="btn btn-primary" id="addTpSubmitBtn">{{ __('Submit') }}</button>
            @error('firstname', 'lastname')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </form>
        @if ($errors->any())
            <br>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('tpAdded'))
            <div class="alert alert-success mt-4" style="font-weight: bold">
                {{ session()->get('tpAdded') }}
            </div>
        @endif
    </div>
@endsection
