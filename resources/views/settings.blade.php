@extends('layouts.dashboard')

@section('content')
@component('components.header')
@slot('title', 'User Settings')
@endcomponent

@component('components.form')
@slot('action', url("/user/settings"))
@slot('method', 'PUT')
@slot('button', 'Update')
<div class="w-full mb-6">
    <label for="name" class="input-label">{{ __('Name') }}</label>
    <input id="name" type="text" class="input-text @error('name') input-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>
    @error('name')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="w-full mb-6">
    <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
    <input class="input-text @error('name') input-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') ?? Auth::user()->email }}" required autocomplete="email">
    @error('email')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>
<?php /*
<div class="w-full mb-6">
    <label for="password" class="input-label">{{ __('Password') }}</label>
    <input id="password" type="password" class="input-text @error('password') input-invalid @enderror" name="password" autocomplete="new-password">

    @error('password')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="w-full mb-6">
    <label for="password-confirm" class="input-label">{{ __('Confirm Password') }}</label>
    <input id="password-confirm" type="password" class="input-text" name="password_confirmation" autocomplete="new-password">
</div>
*/ ?>
@endcomponent

<div class="mt-12 relative">
    <h3 class="text-lg font-semibold mb-6">Delete Account</h3>
    This action is permanent and cannot be reversed. All projects and links you own will be deleted. <a class="text-indigo-600 cursor-pointer" id="show-delete">Click here to delete user account</a>.
    <div class="absolute z-50 shadow mx-4 p-4 top-0 bg-white rounded modal hidden" id="delete">
        <span class="input-label">Warning</span>
        <div>
            You're about to delete <span class="font-semibold">this account ({{ Auth::user()->email }})</span>, do you want to proceed?
            <div class="mt-8">
                <form action='{{ url("/user/goodbye") }}' method="POST" class="w-full max-w-lg">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn-danger">Proceed</button>
                    <span class="inline-block ml-4 py-1 cursor-pointer" id="hide-delete">cancel</span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var modal = document.getElementById("delete");
var btn = document.getElementById("show-delete");
var span = document.getElementById("hide-delete");

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}
</script>
@endsection
