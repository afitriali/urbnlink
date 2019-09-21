@extends('layouts.dashboard')

@section('content')
    @component('components.header')
        @slot('title') Create a New Project @endslot
    @endcomponent

    @component('components.form')
        @slot('action') {{ url("/projects") }} @endslot
        @slot('method') POST @endslot
        <div class="w-full mb-6">
            <label for="name" class="input-label">Name</label>
            <input class="input-text @error('name') input-invalid @enderror" id="name" type="text" name="name" max="40" placeholder="Project Name" value ="{{ old('name') }}">
            @error('name')
            <span class="input-error" role="alert">{{ $message }}</span>
        @enderror
        </div>

        <div class="w-full mb-6">
            <label for="description" class="input-label">Description</label>
            <input class="input-text @error('description') input-invalid @enderror" id="description" type="text" name="description" max="160" placeholder="Give your project a brief description" value ="{{ old('description') }}">
            @error('description')
            <span class="input-error" role="alert">{{ $message }}</span>
        @enderror
        </div>
    @endcomponent
@endsection
