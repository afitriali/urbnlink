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
    <li class=""><a href="{{ url($project->name, 'links/'.$link->domain.'/'.$link->name) }}" class="bg-white inline-block px-4 py-2 text-blue-400 text-sm">Statistics</a></li>
    <li class="-mb-px"><span class="bg-white inline-block px-4 py-2 text-gray-500 text-sm border-l border-r border-t rounded-t">Rules</span></li>
</ul>

<div class="text-center mb-12">
    <img src="{{ url('/img/coming-soon.png') }}" class="mx-auto max-h-64 -mt-12 -mb-6" />
    <p class="text-lg text-gray-500 font-light">Coming Soon</p>
</div>

<div class="mt-12 text-sm">
    <a href="{{ url($project->name) }}" class="text-blue-400 border-b-2 border-dotted">See your other links.</a>
</div>
@endsection
