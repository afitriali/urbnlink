@extends('layouts.dashboard')

@section('content')

@component('components.header')
@slot('breadcrumb')
<a href="{{ url('/') }}">🏠</a> → <a href="{{ url($project->name) }}" class="inline-block bg-indigo-100 text-indigo-400 px-2 rounded">{{ $project->name }}</a> → Link
@endslot
@slot('title')
{{ $link->domain.'/'.$link->name }}
@endslot
@endcomponent

<p class="text-xs text-gray-500">🌐 {{ $link->url }}</p>
<p class="text-xs text-gray-500">{{ $link->created_at }}</p>
@endsection
