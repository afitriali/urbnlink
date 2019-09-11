@extends('layouts.dashboard')

@section('content')

@component('components.header')
@slot('breadcrumb')
<a href="{{ url('/') }}">🏠</a> → Project
@endslot
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
<label for="name">Project Name</label>
<input type="text" name="name" maxlength="40" placeholder="Project Name" value="{{ old('name') }}">
<br>
<label for="description">Description</label>
<input type="text" name="description" maxlength="160" placeholder="Give a brief description of your project" value="{{ old('description') }}"/>
@endcomponent

@endsection
