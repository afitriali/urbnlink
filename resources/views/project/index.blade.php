@extends('layouts.dashboard')

@section('create_button')
    @can('create', App\Project::class)
        <a href='{{ url("/projects/create") }}' class="btn items-center flex">
            <svg class="feather h-4 w-4 -ml-1"><use xlink:href="{{ url('/img') }}/feather-sprite.svg#plus"/></svg>
            <span class="ml-1">Project</span>
        </a>
    @endcan
@endsection

@section('content')
    @component('components.header')
        @slot('title') {{ 'Hello, '.explode(' ', Auth::user()->name)[0].'.' }} @endslot
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
            @slot('url') {{ url("/{$project->name}") }} @endslot
            @slot('name') {{ $project->name }} @endslot
            @slot('description') {{ $project->description }} @endslot
            <div class="inline-block bg-gray-200 py-1 px-2 rounded flex items-center">
                <svg class="feather h-3 w-3"><use xlink:href="{{ url('/img') }}/feather-sprite.svg#link"/></svg>
                <span class="ml-1">{{ $project->links()->count() }}</span>
            </div>
            <div class="inline-block bg-gray-200 py-1 px-2 ml-2 rounded flex items-center">
                <svg class="feather h-3 w-3"><use xlink:href="{{ url('/img') }}/feather-sprite.svg#layout"/></svg>
                <span class="ml-1">{{ $project->pages()->count() }}</span>
            </div>
            <div class="inline-block bg-gray-200 py-1 px-2 ml-2 rounded flex items-center">
                <svg class="feather h-3 w-3"><use xlink:href="{{ url('/img') }}/feather-sprite.svg#globe"/></svg>
                <span class="ml-1">{{ $project->domains()->count() }}</span>
            </div>
            <div class="inline-block bg-gray-200 py-1 px-2 ml-2 rounded flex items-center">
                <svg class="feather h-3 w-3"><use xlink:href="{{ url('/img') }}/feather-sprite.svg#users"/></svg>
                <span class="ml-1">{{ $project->members()->count() }}</span>
            </div>
        @endcomponent
    @endforeach
</ul>
<div class="mt-12">
    @cannot('create', App\Project::class)
        <p><span class="font-semibold block">You can't add anymore projects.</span><a href="#" class="text-indigo-600 border-b-2 border-dotted">Upgrade to Pro</a> or delete an existing project.</p>
    @endcannot
</div>
@else
    <div class="text-right">
        <img src='{{ url("/img/first-project.png") }}' class="mx-auto max-h-64 rounded-lg -mb-4" />
        @can('create', App\Project::class)
            <a href='{{ url("/projects/create") }}' class="btn mr-4">Start a Project</a>
        @endcan
    </div>
@endisset
@endsection
