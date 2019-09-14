@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
Project
@endcomponent
@endsection

@section('content')
@component('components.header')
@slot('title')
{{ $project->name }}
@endslot
@slot('sub_title')
{{ $project->description }}
@endslot
@endcomponent

@isset($links[0])
<div class="my-8 text-right">
    <a href="{{ url()->current() }}/link/create" class="btn">New Link</a>
</div>
<ul>
    @foreach ($links as $link)
    <a href="{{ url($project->name.'/link/'.$link->domain.'/'.$link->name) }}">
        <li class="mb-4">
            <h3 class="text-lg font-semibold text-blue-700">{{ $link->domain.'/'.$link->name }}</h3>
            <p class="text-sm text-gray-500 font-light truncate">{{ $link->url }}</p>
            <div class="flex items-center text-xs text-gray-500 capitalize">
                <i data-feather="bar-chart-2" class="h-4 w-4"></i><span class="ml-2">{{ $link->hits()->count() }}</span>
            </div>
        </li>
    </a>
    @endforeach
</ul>
@else
<div class="text-center mb-12">
    <img src="{{ url('/img/first-link.png') }}" class="mx-auto max-h-64 -mt-12 -mb-6" />
    <a href="{{ url()->current() }}/link/create" class="btn">Let's Make Your First Link</a>
</div>
@endisset
<div class="mt-8 text-sm">
    <a href="{{ url('/') }}" class="text-blue-400 border-b-2 border-dotted">See your other projects.</a>
</div>
@endsection
