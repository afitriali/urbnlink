@extends('layouts.dashboard')

@section('navigation')
<h1 class="inline text-lg font-semibold tracking-wider">{{ config('app.name') }}</h1>
@endsection

@section('content')
@component('components.header')
@slot('title')
Hello, {{ explode(" ", Auth::user()->name)[0] }}.
@endslot
@slot('sub_title')
@isset($projects[0])
Which project are you working on today?
@else
You don't have any projects yet.
@endisset
@endslot
@endcomponent

@isset($projects[0])
<ul>
    @foreach ($projects as $project)
    @component('components.card')
    @slot('url')
    {{ url($project->name) }}
    @endslot
    @slot('name')
    {{ $project->name }}
    @endslot
    @slot('description')
    {{ $project->description }}
    @endslot
    {{ $project->links()->count() }} links &nbsp;&nbsp;
    {{ $project->pages()->count() }} pages &nbsp;&nbsp;
    {{ $project->domains()->count() }} domains &nbsp;&nbsp;
    {{ $project->members()->count() }} members &nbsp;&nbsp;
    @endcomponent
    @endforeach
</ul>
<div class="my-8">
    @can('create', App\Project::class)
    <a href="{{ url('project/create') }}" class="btn">Add Another Project</a>
    @else
    <p class="text-gray-500"><span class="font-semibold block">You can't add anymore project.</span><a href="#" class="text-indigo-500 border-b-2 border-dotted">Upgrade to Pro</a> or delete an existing project.</p>
    @endcan
</div>
@else
<div class="my-8 text-center">
    <img src="{{ url('/img/first-project.png') }}" class="mx-auto max-h-64 -mt-12 -mb-6" />
    @can('create', App\Project::class)
    <a href="{{ url('project/create') }}" class="btn">Start a Project</a>
    @endcan
</div>
@endisset
@endsection
