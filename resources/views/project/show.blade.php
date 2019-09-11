@extends('layouts.dashboard')

@section('content')
<ul>
    <li><a href="{{ url()->current() }}/link/create">Create Link</a></li>
    <li><a href="{{ url()->current() }}/page/create">Create Page</a></li>
</ul>

@endsection
