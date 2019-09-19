@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
Project
@endcomponent
@endsection

@section('create_button')
<a href='{{ url("/{$project->name}/links/create") }}' class="btn items-center flex"><i data-feather="plus" class="inline h-4 w-4 -ml-1"></i><span class="ml-1">Link</span></a>
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

<ul class=" flex border-b mb-8">
    <li class="-mb-px"><span class="bg-white inline-block px-4 py-2 border-l border-r border-t rounded-t">Links</span></li>
    <li class=""><a href='{{ url("/{$project->name}/pages") }}' class="inline-block px-4 py-2 text-indigo-600">Pages</a></li>
    @can('manage', $project)
    <li class=""><a href='{{ url("/{$project->name}/settings") }}' class="inline-block px-4 py-2 text-indigo-600">Settings</a></li>
    @endcan
</ul>

@isset($links[0])
<div class="my-8 text-right">
</div>
<ul>
    @foreach ($links as $link)
    <a href='{{ url("/{$project->name}/links/{$link->domain}/{$link->name}") }}'>
        <li class="border-b p-2 hover:bg-indigo-100">
            <h3 class="text-xl text-indigo-600">{{ $link->domain.'/'.$link->name }}</h3>
            <p class="font-light truncate">{{ $link->url }}</p>
            <div class="flex items-center text-xs text-gray-500 mt-2 capitalize">
                <span class="mr-4">{{ \Carbon\Carbon::parse($link->created_at)->diffForHumans() }}</span><i data-feather="bar-chart-2" class="h-4 w-4"></i><span class="ml-2">{{ $link->hits()->count() }}</span>
            </div>
        </li>
    </a>
    @endforeach
</ul>
@else
<div class="text-right">
    <img src='{{ url("/img/first-link.png") }}' class="mx-auto max-h-64 -mb-4" />
    <a href='{{ url("/{$project->name}/links/create") }}' class="btn mr-4">Let's Make Your First Link</a>
</div>
@endisset
<div class="mt-12">
    <a href='{{ url("/") }}' class="text-indigo-600 border-b-2 border-dotted">See your other projects.</a>
</div>
@endsection
