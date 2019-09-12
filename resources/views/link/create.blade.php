@extends('layouts.dashboard')

@section('content')

@section('navigation')
@component('components.breadcrumbs')
<a href="{{ url($project->name) }}" class="inline-block bg-indigo-100 text-indigo-400 px-2 rounded">{{ $project->name }}</a> → Link
@endcomponent
@endsection

@component('components.header')
@slot('title')
Create a New Link
@endslot
@endcomponent

@component('components.form')
@slot('action')
{{ url($project->name.'/link') }}
@endslot
@slot('method')
POST
@endslot

<div class="w-full px-0 mb-6">
    <label class="block uppercase tracking-wide text-gray-500 text-xs mb-2" for="domain">
        Domain
    </label>
    <div class="relative">
        <select class="block appearance-none w-full bg-indigo-100 border border-indigo-100 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-100" name="domain">
            <option value="" default>{{ env('DEFAULT_SHORT_DOMAIN') }}</option>
            @foreach ($domains as $domain)
            <option value="{{ $domain->name }}" <?= old('domain') === $domain->name ? 'selected="selected"' : '' ?>>{{ $domain->name }}</option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
    </div>
</div>

<div class="w-full px-0 mb-6">
    <label class="block uppercase tracking-wide text-gray-500 text-xs mb-2" for="name">
        Short Name
    </label>
    <input class="appearance-none block w-full bg-indigo-100 border @error('name') border-red-400 @else border-indigo-100 @enderror rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name="name" max="40" placeholder="Short name after domain" value ="{{ old('name') }}">
    @error('name')
        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="w-full px-0 mb-6">
    <label class="block uppercase tracking-wide text-gray-500 text-xs mb-2" for="url">
        URL
    </label>
    <input class="appearance-none block w-full bg-indigo-100 border @error('url') border-red-400 @else border-indigo-100 @enderror rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name="url" placeholder="Forward to this URL" value ="{{ old('url') }}">
    @error('url')
        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
@endcomponent
@endsection
