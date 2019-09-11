@extends('layouts.dashboard')

@section('content')

@component('components.header')
@slot('breadcrumb')
<a href="{{ url('/') }}">🏠</a> → Project
@endslot
@slot('title')
{{ $project->name }}
@endslot
@endcomponent

<p class="-mt-4 italic text-sm text-gray-400 mb-6 truncate">{{ $project->description }}</p>

<a href="{{ url()->current() }}/link/create" class="btn">Create Link</a></li>
<ul>
    @foreach ($project->links()->get() as $link)
    <a href="{{ url($project->name.'/link/'.$link->domain.'/'.$link->name) }}">
        <li class="block my-2 p-2 shadow-md rounded">
            <h3 class="text-lg font-semibold">{{ $link->domain.'/'.$link->name }}</h3>
            <p class="text-xs text-gray-500 uppercase">
            <b>{{ $link->hits()->count() }}</b> hits
            </p>
        </li>
    </a>
    @endforeach
</ul>
@endsection
