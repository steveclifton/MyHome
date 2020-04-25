@extends('layouts.default')

@section ('title')Home | @endsection

@section('content')

    <div id="app">
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>

    @foreach($readings as $date => $reading)
        {{ $date }}
        @foreach($reading as $key => $value)
            {{ $key . ': ' . $value }}
        @endforeach
        <br>
    @endforeach


@endsection
