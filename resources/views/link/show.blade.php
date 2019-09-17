@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
<a href="{{ url($project->name) }}" class="text-blue-400">{{ $project->name }}</a><span class="mx-2">→</span>Link
@endcomponent
@endsection

@section('create_button')
<a href="{{ url('/').'/'.$project->name.'/links/create' }}" class="btn-secondary">Create Link</a>
@endsection

@section('content')
@component('components.header')
@slot('title')
{{ $link->domain.'/'.$link->name }}
@endslot
@slot('sub_title')
{{ $link->url }}
@endslot
@endcomponent

<ul class=" flex border-b mb-8">
    <li class="-mb-px"><span class="bg-white inline-block px-4 py-2 text-gray-500 text-sm border-l border-r border-t rounded-t">Statistics</span></li>
    <li class=""><a href="{{ url()->current().'/rules' }}" class="inline-block px-4 py-2 text-blue-400 text-sm">Rules</a></li>
</ul>

@if ($stats['total'] > 0)
<canvas id="chart" height="100"></canvas>
<div class="mt-6 leading-loose">
    <h3 class="text-gray-500 uppercase text-xs tracking-wide mb-2">Top Referrers</h3>
    @foreach ($stats['referrers'] as $referrer=>$value)
    <div class="flex items-center font-light text-sm">
        <div class="flex-none inline-block bg-blue-100 text-blue-400 text-xs px-2 py-0 rounded">{{ $value }}</div>
        <div class="flex-auto inline-block truncate ml-2">{{ $referrer }}</div>
    </div>
    @endforeach
</div>
<div class="mt-6 leading-loose">
    <h3 class="text-gray-500 uppercase text-xs tracking-wide mb-2">Top Pages Visited</h3>
    @foreach ($stats['page'] as $page=>$value)
    <div class="flex items-center font-light text-sm">
        <div class="flex-none inline-block bg-blue-100 text-blue-400 text-xs px-2 py-0 rounded">{{ $value }}</div>
        <div class="flex-auto inline-block truncate ml-2">{{ $page }}</div>
    </div>
    @endforeach
</div>
@else
<div class="text-center">
    <img src="{{ url('/img/empty-statistics.png') }}" class="mx-auto max-h-64 -mt-12 -mb-6" />
    <p class="text-lg text-gray-500 font-light">Hold on, no statistics yet.</p>
</div>
@endif

<div class="mt-12 text-sm">
    <a href="{{ url($project->name) }}" class="text-blue-400 border-b-2 border-dotted">See your other links.</a>
</div>
@endsection

@section('scripts')
<script>
    var ctx = document.getElementById('chart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: [{!! implode(', ', array_keys($stats['hits'])) !!}],
        datasets: [{
            backgroundColor: '#bee3f8',
            data: [{{ implode(', ', $stats['hits']) }}]
        }]
    },

    // Configuration options go here
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
</script>
@endsection
