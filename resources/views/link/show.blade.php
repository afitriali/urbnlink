@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
<a href="{{ url($project->name) }}" class="border-b-2 border-dotted">{{ $project->name }}</a> → Link
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

<p class="text-sm text-gray-500">{{ $link->created_at }}</p>

<div class="mt-8 text-sm">
    <a href="{{ url('/'.$project->name) }}" class="text-blue-400 border-b-2 border-dotted">See your other links.</a>
</div>
@endsection
