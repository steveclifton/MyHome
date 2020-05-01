@extends('layouts.templates.auth')

@section ('title')Home | @endsection

@section('content')
<div class="container">

    @if (!empty($summary))
    <div class="row">
        @foreach ($summary as $sum)
            <div class="col">
                <div class="card weather-card">
                    <div class="card-body pb-3">
                        <h4 class="card-title font-weight-bold">{{ $sum['name'] }}</h4>
                        <p class="card-text">Last updated: {{ $sum['lastupdated'] ?? '' }}</p>

                        <div class="d-flex justify-content-between" style="padding: 10px 0px 40px 0px">
                            <p class="display-1 degree" style="margin: auto;">{{ number_format($sum['now'] ?? 0, 1) }}&#176;</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="display-5"  style="margin: auto;">High</p>
                            <p class="display-5"  style="margin: auto;">Low</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="display-4" style="color: red">{{ number_format($sum['high'] ?? 0, 1) }}&#176;</p>
                            <p class="display-4" style="color: blue">{{ number_format($sum['low'] ?? 0, 1) }}&#176;</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>{{ round($summary['humidity'] ?? '') }}% Humidity</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    @if ( !empty($chart) )
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        @foreach ($chart as $deviceid => $c)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chLine-{{$deviceid}}"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                var chartSourceData = {!! json_encode($c) !!};
                var chLine = document.getElementById("chLine-{{$deviceid}}");

                if (chLine) {
                    new Chart(chLine, {
                        type: 'line',
                        data: {
                            labels: chartSourceData.times,
                            datasets: [
                                {
                                    data: chartSourceData.temps,
                                    // backgroundColor: '#2ebf91',
                                    borderColor: '#8360c3',
                                    borderWidth: 4,
                                    pointBackgroundColor: '#007bff'
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: chartSourceData.name
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: false
                                    }
                                }]
                            },
                            legend: {
                                display: false
                            }
                        }
                    });
                }
            </script>
        @endforeach
    @endif

    @if ( !empty($table) )
        <div class="row">
            <div class="col">
                <table class="table table-dark table-hover" style="opacity: 60%">
                <thead>
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Temp</th>
                    <th scope="col">Pressure</th>
                    <th scope="col">Humidity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($table as $date => $reading)
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
        </div>
    @endif
</div>

@endsection
