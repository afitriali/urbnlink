@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
Project
@endcomponent
@endsection

@section('content')
@component('components.header')
@slot('title')
Create a New Project
@endslot
@endcomponent

@component('components.form')
@slot('action')
{{ url('/project')}}
@endslot
@slot('method')
POST
@endslot

<div class="w-full px-0 mb-6">
    <label class="block uppercase tracking-wide text-gray-500 text-xs mb-2" for="name">
        Name
    </label>
    <input class="appearance-none block w-full bg-indigo-100 border @error('name') border-red-400 @else border-indigo-100 @enderror rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name="name" max="40" placeholder="Project Name" value ="{{ old('name') }}">
    @error('name')
        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="w-full px-0 mb-6">
    <label class="block uppercase tracking-wide text-gray-500 text-xs mb-2" for="description">
        Description
    </label>
    <input class="appearance-none block w-full bg-indigo-100 border @error('description') border-red-400 @else border-indigo-100 @enderror rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white" type="text" name="description" max="160" placeholder="Give your project a brief description" value ="{{ old('description') }}">
    @error('description')
        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
@endcomponent
@endsection
