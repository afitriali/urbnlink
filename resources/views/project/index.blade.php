@extends('layouts.dashboard')

@section('content')
<h2 class="text-xl font-bold mb-4">Projects</h2>
@can('create', App\Project::class)
<a href="{{ url('project/create') }}" class="inline-block bg-gray-900 text-white rounded px-4 py-2">Create Project</a></li>
@endcan
<ul>
    @foreach ($data['projects'] as $project)
    <a href="{{ url($project->name) }}">
        <li class="block my-2 p-2 shadow-md rounded">
            <h3 class="text-lg font-semibold">{{ $project->name }}</h3>
            <p class="text-xs text-gray-500 uppercase">
            <b>{{ $project->links()->count() }}</b> links,
            <b>{{ $project->pages()->count() }}</b> pages
            </p>
        </li>
    </a>
    @endforeach
</ul>
@endsection
