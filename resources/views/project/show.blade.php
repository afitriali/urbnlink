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
<div class="my-8 text-right">
<a href="{{ url()->current() }}/link/create" class="btn">Create a New Link</a>
</div>
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
<div class="my-8 text-center">
    <img src="{{ url('/img/first-link.png') }}" class="mx-auto max-h-64 -mt-12 -mb-6" />
    <a href="{{ url()->current() }}/link/create" class="btn mb-8">Let's Create Your First Link</a>
</div>
@endisset
@endsection
