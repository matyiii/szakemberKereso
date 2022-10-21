@extends('layouts.app')

@section('content')
    @foreach ($tradespersons as $tp)
    <p>Name: {{ $tp->firstname }} {{ $tp->lastname}}</p>
    @endforeach
@endsection