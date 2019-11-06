@extends('layouts.landing')

@section('content')
<div class="mx-6 mb-8">
    @component('components.header')
    @slot('title')
    Reset Password
    @endslot
    @endcomponent

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="w-full mb-6">
            <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
            <input class="input-text @error('name') input-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
            <button type="submit" class="btn">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>
@endsection
