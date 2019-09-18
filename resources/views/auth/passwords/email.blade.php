@extends('layouts.landing')

@section('content')
<div class="mx-6 mb-8">
    @component('components.header')
    @slot('title')
    Reset Password
    @endslot
    @endcomponent

    @if (session('status'))
    <div class="bg-teal-200 text-teal-900 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="w-full mb-6">
            <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
            <input class="input-text @error('name') input-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="input-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full my-8">
            <button type="submit" class="btn">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
</div>
@endsection
