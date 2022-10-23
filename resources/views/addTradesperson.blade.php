@extends('layouts.app')

@section('content')
    <div class="col-6" id="addTpForm">
        <form method="POST">
            @csrf
            <label for="firstname">Firstname:</label>
            <input type="text" id="firstname" name="firstname" class="form-control" value="tesztfirstname">
            <label for="lastname">Lastname:</label>
            <input type="text" id="lastname" name="lastname" class="form-control" value="tesztlastname">
            <label for="zip">ZIP:</label>
            <input type="text" id="zip" name="zip" class="form-control" value="1234">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" class="form-control" value="tesztcity">
            <label for="trade">Trade:</label>
            <input type="text" id="trade" name="trade" class="form-control" value="teszttrade">
            <label for="prictures">Pictures:</label>
            <input type="file" id="prictures" name="prictures" class="form-control" multiple>
            <div id="highlighted">
                <label for="highlighted">Highlighted person:</label>
                <input type="checkbox" id="highlighted" name="highlighted" class="form-check-input">
            </div>
            <button type="submit" class="btn btn-primary" id="addTpSubmitBtn">Submit</button>
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
    </div>
@endsection
