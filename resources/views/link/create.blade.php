@extends('layouts.dashboard')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form action="/project" method="POST">
        @csrf
        <label for="name">Project Name</label>
        <input type="text" name="name" maxlength="40" placeholder="Project Name" value="{!!old('name')!!}"/>
        <label for="description">Description</label>
        <input type="text" name="description" maxlength="160" placeholder="Give a brief description of your project" value="{!!old('description')!!}"/>
        <button type="submit">Create</button>
    </form>
</div>
@endsection
