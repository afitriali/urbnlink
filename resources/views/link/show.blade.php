@extends('layouts.dashboard')

@section('content')
<p class="text-xs text-gray-500 uppercase tracking-wide mt-6"><span class="text-teal-600">{{ $project->name }}</span> → Link</p>
<h2 class="text-xl font-bold mb-4">{{ $link->domain.'/'.$link->name }}</h2>
<p class="text-xs text-gray-500">🌐 {{ $link->url }}</p>
<p class="text-xs text-gray-500">{{ $link->created_at }}</p>
@endsection
