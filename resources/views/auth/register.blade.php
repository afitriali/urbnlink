@extends('layouts.landing')

@section('content')
<div class="mx-6 mb-8">
    @component('components.header')
    @slot('title')
    Sign Up
    @endslot
    @endcomponent

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="w-full mb-6">
            <label for="name" class="input-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="input-text @error('name') input-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="input-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full mb-6">
            <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
            <input class="input-text @error('name') input-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="input-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full mb-6">
            <label for="password" class="input-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="input-text @error('password') input-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="input-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full mb-6">
            <label for="password-confirm" class="input-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="input-text" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="w-full my-8">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
@endsection
