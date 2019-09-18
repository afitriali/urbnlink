@extends('layouts.landing')

@section('content')
<div class="mx-6 my-8 text-center">
    <img src="{{ url('/img/404.png') }}" class="mx-auto max-h-64 rounded-lg mb-6" />
    <p class="text-lg font-light">404 | Page or link not found</p>
</div>
@endsection
