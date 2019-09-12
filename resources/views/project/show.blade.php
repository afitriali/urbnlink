@extends('layouts.dashboard')

@section('navigation')
@component('components.breadcrumbs')
Project
@endcomponent
@endsection

@section('content')
@component('components.header')
@slot('title')
{{ $project->name }}
@endslot
@slot('sub_title')
{{ $project->description }}
@endslot
@endcomponent

@isset($links[0])
<a href="{{ url()->current() }}/link/create" class="btn mb-8">Create a New Link</a>
<ul>
    @foreach ($links as $link)
    @component('components.card')
    @slot('url')
    {{ url($project->name.'/link/'.$link->domain.'/'.$link->name) }}
    @endslot
    @slot('name')
    {{ $link->domain.'/'.$link->name }}
    @endslot
    @slot('description')
    {{ $link->url }}
    @endslot
    {{ $link->hits()->count() }} hits
    @endcomponent
    @endforeach
</ul>
@else
<a href="{{ url()->current() }}/link/create" class="btn mb-8">Let's Create Your First Link</a>
@endisset
@endsection
