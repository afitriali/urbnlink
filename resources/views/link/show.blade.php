@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
<a href="{{ url($project->name) }}" class="inline-block bg-indigo-100 text-indigo-400 px-2 rounded">{{ $project->name }}</a> → Link
@endcomponent
@endsection

@section('content')
@component('components.header')
@slot('title')
{{ $link->domain.'/'.$link->name }}
@endslot
@slot('sub_title')
{{ $link->url }}</p>
@endslot
@endcomponent

<p class="text-xs text-gray-500">{{ $link->created_at }}</p>
@endsection
