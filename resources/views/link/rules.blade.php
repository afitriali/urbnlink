@extends('layouts.dashboard')

@section('content')
    @component('components.header')
        @slot('title') {{ $link->domain.'/'.$link->name }} @endslot
        @slot('sub_title')
            {{ $link->url }}
            <span class="block mt-2 text-gray-500">in <a href='{{ url($project->name) }}' class="text-indigo-600 border-b-2 border-dotted">{{ $project->name }}</a></span>
        @endslot
    @endcomponent

    <ul class=" flex border-b mb-8">
        <li class=""><a href='{{ url("/{$project->name}/links/{$link->domain}/{$link->name}") }}' class="bg-white inline-block px-4 py-2 text-indigo-600">Statistics</a></li>
        <li class="-mb-px"><span class="bg-white inline-block px-4 py-2 border-l border-r border-t rounded-t">Rules</span></li>
        <li class=""><a href='{{ url("/{$project->name}/links/{$link->domain}/{$link->name}/edit") }}' class="bg-white inline-block px-4 py-2 text-indigo-600">Edit</a></li>
    </ul>

    <div class="text-center">
        <img src='{{ url("/img/coming-soon.png") }}' class="mx-auto max-h-64 mb-6 rounded-lg" />
        <p class="text-lg font-light">Coming Soon</p>
    </div>

    <div class="mt-12">
        <a href='{{ url($project->name) }}' class="text-indigo-600 border-b-2 border-dotted">See your other links.</a>
    </div>
@endsection
