@extends('layouts.dashboard')

@section('content')
<h2 class="text-xl font-bold mb-4">Create a New Project</h2>
<form action="/project" method="POST">
    @csrf
    <label for="name">Project Name</label>
    <input type="text" name="name" maxlength="40" placeholder="Project Name" value="{{ old('name') }}">
    <br>
    <label for="description">Description</label>
    <input type="text" name="description" maxlength="160" placeholder="Give a brief description of your project" value="{{ old('description') }}"/>
    <br>
    <button type="submit" class="btn">Create</button>
</form>
@endsection
