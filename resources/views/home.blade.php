@extends('layouts.app')

@section('content')
    <div id="mainContent">
        <div class="col-3" id="left">
            <h3>{{ __('Highlighted tradepersons:') }}</h3>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card">
                            <img src="https://via.placeholder.com/200" class="d-block w-100" alt="tradespersonPlaceholder">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Firstname Lastname') }}</h5>
                                <p class="card-text">{{ __('Trade') }}</p>
                                <p class="card-text">{{ __('Introduction') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Details') }}</a>
                            </div>
                        </div>
                    </div>
                    @foreach ($highlighted as $person)
                        <div class="carousel-item">
                            <div class="card">
                                <img src="https://via.placeholder.com/200" class="d-block w-100"
                                    alt="tradespersonPlaceholder">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $person->firstname }} {{ $person->lastname }}</h5>
                                    <p class="card-text">{{ $person->trade == '' ? 'No trade' : $person->trade }}</p>
                                    <p class="card-text">{{ $person->introduction }}</p>
                                    <a href="#" class="btn btn-primary">{{ __('Details') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-6" id="middle">
            <h1>TESZT</h1>
        </div>
        <div class="col-3" id="right">
            <h3>{{ __('Trades') }}:</h3>
            @foreach ($trades as $trade)
                <p>{{ $trade->name }}</p>
            @endforeach
        </div>
    </div>
@endsection
