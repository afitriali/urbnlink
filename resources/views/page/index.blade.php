@extends('layouts.dashboard')

@section('content')
    @component('components.header')
        @slot('title') {{ $project->name }} @endslot
        @slot('sub_title') {{ $project->description }} @endslot
    @endcomponent

    <ul class=" flex border-b mb-8">
        <li class=""><a href='{{ url($project->name) }}' class="inline-block px-4 py-2 text-indigo-600">Links</a></li>
        <li class="-mb-px"><span class="bg-white inline-block px-4 py-2 border-l border-r border-t rounded-t">Pages</span></li>
        @can('manage', $project)
            <li class=""><a href='{{ url("/{$project->name}/settings") }}' class="inline-block px-4 py-2 text-indigo-600">Settings</a></li>
        @endcan
    </ul>

    @isset($pages[0])
    <div class="my-8 text-right">
    </div>
    <ul>
        @foreach ($pages as $page)
            <a href='{{ url("/{$project->name}/pages/{$page->name}") }}'>
                <li class="border-b p-2 hover:bg-indigo-100">
                    <h3 class="text-lg text-indigo-600">{{ $page->name }}</h3>
                </li>
            </a>
        @endforeach
    </ul>
@else
    <div class="text-center mb-12">
        <img src='{{ url("/img/coming-soon.png") }}' class="mx-auto max-h-64 mb-6" />
        <p class="text-lg font-light">Coming Soon</p>
    </div>
@endisset
<div class="mt-12">
    <a href='{{ url("/") }}' class="text-indigo-600 border-b-2 border-dotted">See your other projects.</a>
</div>
@endsection
