@extends('layouts.dashboard')

@section('content')

@component('components.header')
@slot('breadcrumb')
<a href="{{ url('/') }}">🏠</a> → <a href="{{ url($project->name) }}" class="inline-block bg-indigo-100 text-indigo-400 px-2 rounded">{{ $project->name }}</a> → Link
@endslot
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
<label for="name">Name</label>
<input type="text" name="name" maxlength="40" placeholder="Short URL" value="{{ old('name') }}"/>
<br>
<label for="url">URL</label>
<input type="text" name="url" placeholder="URL" value="{{ old('url') }}"/>
@endcomponent

@endsection
