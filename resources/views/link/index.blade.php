@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
Project
@endcomponent
@endsection

@section('create_button')
<a href="{{ url()->current().'/links/create' }}" class="btn-secondary">Create Link</a>
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
    <li class="-mb-px"><span class="bg-white inline-block px-4 py-2 text-gray-500 text-sm border-l border-r border-t rounded-t">Links</span></li>
    <li class=""><a href="{{ url($project->name, 'pages') }}" class="inline-block px-4 py-2 text-blue-400 text-sm">Pages</a></li>
    @can('manage', $project)
    <li class=""><a href="{{ url($project->name, 'settings') }}" class="inline-block px-4 py-2 text-blue-400 text-sm">Settings</a></li>
    @endcan
</ul>

@isset($links[0])
<div class="my-8 text-right">
</div>
<ul>
    @foreach ($links as $link)
    <a href="{{ url($project->name, 'links/'.$link->domain.'/'.$link->name) }}">
        <li class="border-b p-2 hover:bg-blue-100">
            <h3 class="text-lg text-blue-400">{{ $link->domain.'/'.$link->name }}</h3>
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
    <a href="{{ url()->current().'/links/create' }}" class="btn">Let's Make Your First Link</a>
</div>
@endisset
<div class="mt-12 text-sm">
    <a href="{{ url('/') }}" class="text-blue-400 border-b-2 border-dotted">See your other projects.</a>
</div>
@endsection
