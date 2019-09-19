@extends('layouts.dashboard')

@section('content')

@section('navigation')
@component('components.breadcrumbs')
<a href="{{ url($project->name) }}" class="text-blue-400">{{ $project->name }}</a><span class="mx-2">→</span>Link
@endcomponent
@endsection

@component('components.header')
@slot('title', 'Create a New Link')
@slot('sub_title')
<span class="block mt-2 text-gray-500">in <a href='{{ url($project->name) }}' class="text-indigo-600 border-b-2 border-dotted">{{ $project->name }}</a></span>
@endslot
@endcomponent

@component('components.form')
@slot('action', url("/{$project->name}/links"))
@slot('method', 'POST')

<div class="w-full mb-6">
    <label for="domain" class="input-label">Domain</label>
    <div class="relative">
        <select class="input-text pr-8" name="domain">
            @foreach ($domains as $domain)
            <option value="{{ $domain }}" <?= old('domain') === $domain ? 'selected="selected"' : '' ?>>{{ $domain }}</option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
    </div>
</div>

<div class="w-full mb-2">
    <span class="input-label">Forward to</span>
    <div class="flex">
        @foreach ($link_types as $link_type)
        <div class="mr-6">
            <label>
                <input type="radio" name="link_type_id" value="{{ $link_type->id }}"  <?= old('link_type_id') == $link_type->id || (old('link_type_id') === null && $link_type->id === 10) ? 'checked' : '' ?>>
                <span class="ml-1">{{ $link_type->name }}</span>
            </label>
        </div>
        @endforeach
    </div>
</div>

<div class="w-full mb-6">
    <input class="input-text @error('url') input-invalid @enderror" id="url" type="text" name="url" placeholder="Paste your original URL here" value ="{{ old('url') }}">
    @error('url')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="w-full mb-6">
    <label for="name" class="input-label">Short Name (Optional)</label>
    <input class="input-text @error('name') input-invalid @enderror" id="name" type="text" name="name" max="40" placeholder="Short name for your URL" value ="{{ old('name') }}">
    @error('name')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>
@endcomponent
@endsection
