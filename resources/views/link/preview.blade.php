@extends('layouts.landing')

@section('script_head')
    <script src="{{ asset('js/Chart.min.js') }}" defer></script>
@endsection

@section('content')
    <div class="mx-6 mb-8">
        @component('components.header')
            @slot('title') {{ $link->domain.'/'.$link->name }} @endslot
            @slot('sub_title') {{ $link->url }} @endslot
        @endcomponent

        @if ($stats['total'] > 0)
            <canvas id="chart" height="100"></canvas>
        @else
            <div class="text-center">
                <img src="{{ url('/img/empty-statistics.png') }}" class="mx-auto max-h-64 -mt-12 -mb-6" />
                <p class="text-lg text-gray-500 font-light">Hold on, no statistics yet.</p>
            </div>
        @endif
    </div>
@endsection

@section('script_body')
    <script>
        window.onload = function () {
            var ctx = document.getElementById('chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [{!! implode(', ', array_keys($stats['hits'])) !!}],
                    datasets: [{
                        backgroundColor: '#a3bffa',
                        data: [{{ implode(', ', $stats['hits']) }}]
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                display: false    
                            },
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }]
                    }
                }
            });
        };
    </script>
@endsection
