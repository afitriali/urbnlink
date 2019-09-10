@extends('layouts.dashboard')

@section('content')
<ul>
    <li><a href="{{ url('project/create') }}">Create Project</a></li>
    @foreach ($data['projects'] as $project)
    <a href="{{ url($project->name) }}"><li>{{ $project->name}}</li></li>
    @endforeach
</ul>
@endsection
