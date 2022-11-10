@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5" id="tradespersonList">
        <div class="row">
            @foreach ($allTp as $tp)
                <div class="col-md-2">
                    <div class="card" style="width: 10rem;">
                        <img src="https://via.placeholder.com/100" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tp->firstname }} {{ $tp->lastname }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Id: {{ $tp->id }}</h6> {{-- Értékelés jöhet ide --}}
                            {{-- <p class="card-text">{{ $tp->tradeName }}</p> --}}
                            <p class="card-text">
                                @foreach ($tp->professionsTp as $item)
                                    {{ $item->name }}
                                @endforeach
                            </p>
                            <button type="button" class="btn btn-primary openmodal" data-bs-toggle="modal" id="detailsBtn"
                                data-id="{{ $tp->id }}" data-bs-target="#exampleModal">
                                {{ __('Details') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="tradespersonModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="w-100" id="tradespersonInfo">
                        <tbody></tbody>
                     </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button> {{-- Admin bejelentkezésel update --}}
                </div>
            </div>
        </div>
    </div>
@endsection
