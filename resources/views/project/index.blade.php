@extends('layouts.dashboard')

@section('content')
<div class="mb-6">
<p class="font-semibold">Hello, {{ substr(Auth::user()->name, 0, strpos(Auth::user()->name, ' ')) }}.</p>
<p class="text-gray-500">Which project are you working on today?</p>
</div>

<ul>
    @foreach ($data['projects'] as $project)
    <a href="{{ url($project->name) }}">
        <li class="block mb-4 p-4 shadow-md rounded">
            <h3 class="text-lg text-gray-800 font-semibold">{{ $project->name }}</h3>
            <p class="text-sm text-gray-500 font-light mb-4">{{ $project->description }}</p>
            <p class="text-sm text-gray-500 capitalize">
            {{ $project->links()->count() }} links |  
            {{ $project->pages()->count() }} pages
            </p>
        </li>
    </a>
    @endforeach
</ul>

<div class="mt-6 mb-4 center">
@can('create', App\Project::class)
<a href="{{ url('project/create') }}" class="btn">Add Another Project</a>
@else
<p class="text-gray-500"><span class="font-semibold block">You can't add anymore project.</span><a href="#" class="text-blue-400 border-b-2">Upgrade to Pro</a> or delete existing project to add a new one.</p>

@endcan

@endsection
