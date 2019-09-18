@extends('layouts.landing')

@section('content')
<div class="mx-6 my-8 text-center">
    <img src="{{ url('/img/403.png') }}" class="mx-auto max-h-64 mb-6 rounded-lg" />
    <p class="text-lg font-light">403 | {{ __($exception->getMessage() ?: 'Forbidden') }}
</div>
@endsection
