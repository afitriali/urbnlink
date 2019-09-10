@extends('layouts.dashboard')

@section('content')
<ul>
    <li><a href="{{ url('link/create') }}">Create Link</a></li>
    <li><a href="{{ url('page/create') }}">Create Page</a></li>
</ul>

@endsection
