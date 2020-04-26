@extends('layouts.default')

@section ('title')Home | @endsection

@section('content')

<div class="container">
    @if ( !empty($readings) )
        <div class="row">
            <table class="table table-dark table-hover" style="opacity: 70%">
                <thead>
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Temp</th>
                    <th scope="col">Pressure</th>
                    <th scope="col">Humidity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($readings as $date => $reading)
                    <tr>
                        <th scope="row">{{ $date }}</th>
                        <td>{{ number_format($reading['temperature'] ?? '', 1) }}c</td>
                        <td>{{ $reading['pressure'] ?? '' }}mb</td>
                        <td>{{ intval($reading['humidity'] ?? '') }}%</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div>No Readings Yet</div>
    @endif
</div>

@endsection
