@extends('layouts.dashboard')

@section('content')
<div class="mb-6">
<p class="font-semibold">Hello, {{ substr(Auth::user()->name, 0, strpos(Auth::user()->name, ' ')) }}.</p>
<p class="text-gray-500">Which project are you working on today?</p>
</div>

<ul>
    @foreach ($data['projects'] as $project)
    <a href="{{ url($project->name) }}">
        <li class="group block mb-4 p-4 shadow rounded hover:bg-indigo-100">
            <h3 class="text-lg font-semibold group-hover:text-indigo-900">{{ $project->name }}</h3>
            <p class="text-sm text-gray-500 font-light mb-4 group-hover:text-indigo-900 truncate">{{ $project->description }}</p>
            <p class="text-xs text-gray-500 group-hover:text-indigo-900 capitalize">
            {{ $project->links()->count() }} links &nbsp;&nbsp;
            {{ $project->pages()->count() }} pages &nbsp;&nbsp;
            {{ $project->domains()->count() }} domains &nbsp;&nbsp;
            {{ $project->projectMembers()->count() }} members &nbsp;&nbsp;
            </p>
        </li>
    </a>
    @endforeach
</ul>

<div class="mt-6 mb-4 center">
@can('create', App\Project::class)
<a href="{{ url('project/create') }}" class="btn">Add Another Project</a>
@else
<p class="text-gray-500"><span class="font-semibold block">You can't add anymore project.</span><a href="#" class="text-indigo-500 border-b-2 border-dotted">Upgrade to Pro</a> or delete an existing project.</p>
@endcan

@endsection
