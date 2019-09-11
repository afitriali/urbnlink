@extends('layouts.dashboard')

@section('content')
<p class="text-xs text-gray-500 uppercase tracking-wide"><span class="text-teal-600">{{ $project->name }}</span> → Link</p>
<h2 class="text-xl font-bold mb-4">Create a New Link</h2>
<form action="{{ url($project->name.'/link') }}" method="POST">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" maxlength="40" placeholder="Short URL" value="{{ old('name') }}"/>
    <br>
    <label for="url">URL</label>
    <input type="text" name="url" placeholder="URL" value="{{ old('url') }}"/>
    <br>
    <button type="submit" class="btn">Create</button>
</form>
@endsection
