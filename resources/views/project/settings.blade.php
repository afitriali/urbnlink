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

<ul class=" flex border-b mb-8">
    <li class=""><a href="{{ url($project->name) }}" class="inline-block px-4 py-2 text-blue-400 text-sm">Links</a></li>
    <li class=""><a href="{{ url($project->name, 'pages') }}" class="inline-block px-4 py-2 text-blue-400 text-sm">Pages</a></li>
    <li class="-mb-px"><span class=" bg-white inline-block px-4 py-2 text-gray-500 text-sm border-l border-r border-t rounded-t">Settings</span></li>
</ul>

@component('components.form')
@slot('action', url($project->name))
@slot('method', 'PUT')
@slot('button', 'Update')
@endslot

<div class="w-full mb-6">
    <label for="name" class="input-label">Name</label>
    <input class="input-text @error('name') input-invalid @enderror" id="name" type="text" name="name" max="40" placeholder="Project Name" value ="{{ $project->name }}">
    @error('name')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="w-full mb-6">
    <label for="description" class="input-label">Description</label>
    <input class="input-text @error('description') input-invalid @enderror" id="description" type="text" name="description" max="160" placeholder="Give your project a brief description" value ="{{ $project->description }}">
    @error('description')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>
@endcomponent

<div class="mt-12 text-sm">
    <a href="{{ url('/') }}" class="text-blue-400 border-b-2 border-dotted">See your other projects.</a>
</div>
@endsection
