@extends('layouts.main')

@section('head')
    <title>{{ __('SzakemberKereső') }}</title>
@endsection

@section('content')
    @foreach ($tradespersons as $tp)
        <p>{{ $tp->firstname }}</p>
    @endforeach
@endsection