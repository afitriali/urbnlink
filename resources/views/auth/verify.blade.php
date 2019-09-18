@extends('layouts.dashboard')

@section('content')
@section('navigation')
<a href="{{ config('app.url') }}"><h1 class="inline text-lg font-semibold tracking-wider">{{ config('app.name') }}</h1>
    <span class="inline-block bg-blue-100 text-indigo-600 text-xs px-1 rounded">beta</span>
</a>
@endsection

@component('components.header')
@slot('title')
{{ __('Verify Your Email Address') }}
@endslot
@endcomponent
@if (session('resent'))
<div class="bg-green-100 text-green-400 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">
    {{ __('A fresh verification link has been sent to your email address.') }}
</div>
@endif

<div class="mb-8">
{{ __('Before proceeding, please check your email for a verification link.') }}
{{ __('If you did not receive the email') }},
<form class="inline" method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <button type="submit" class="text-indigo-600 border-b-2 border-dotted">{{ __('click here to request another') }}</button>.
</form>
</div>

@endsection
