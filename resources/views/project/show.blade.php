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
<a href="{{ url()->current() }}/link/create" class="btn">Make a New Link</a>
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
<div class="text-center mb-12">
    <img src="{{ url('/img/first-link.png') }}" class="mx-auto max-h-64 -mt-12 -mb-6" />
    <a href="{{ url()->current() }}/link/create" class="btn">Let's Make Your First Link</a>
</div>
@endisset
<div class="mt-8 text-sm">
    <a href="{{ url('/') }}" class="text-blue-400 border-b-2 border-dotted">See your other projects.</a>
</div>
@endsection
