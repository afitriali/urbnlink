@extends('layouts.landing')

@section('content')
<div class="mx-6 mb-8">
    @component('components.header')
    @slot('title')
    Log In
    @endslot
    @endcomponent

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="w-full mb-6">
            <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
            <input class="input-text @error('name') border-red-400 @else border-indigo-100 @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="input-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full mb-6">
            <label for="password" class="input-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="input-text @error('password') border-red-400 @else border-indigo-100 @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="input-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full mb-6">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <div class="w-full my-8">
            <button type="submit" class="btn">
                {{ __('Log In') }}
            </button>

            @if (Route::has('password.request'))
            <a class="ml-4" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </form>
</div>
@endsection
