@extends('layouts.default')

@section ('title')Home | @endsection

@section('content')

    <div class="container">
        <br>
        <div class="row">
            <table class="table table-dark table-hover" style="opacity: 70%">
                <thead>
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Pressure</th>
                    <th scope="col">Humidity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($readings as $date => $reading)
                    <tr>
                        <th scope="row">{{ $date }}</th>
                        <td>{{ $reading['temperature'] ?? '' }}c</td>
                        <td>{{ $reading['pressure'] ?? '' }}mb</td>
                        <td>{{ $reading['humidity'] ?? '' }}%</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
