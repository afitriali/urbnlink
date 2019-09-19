@extends('layouts.dashboard')

@section('content')
@component('components.header')
@slot('title')
{{ $link->domain.'/'.$link->name }}
@endslot
@slot('sub_title')
{{ $link->url }}
<span class="block mt-2 text-gray-500">in <a href='{{ url($project->name) }}' class="text-indigo-600 border-b-2 border-dotted">{{ $project->name }}</a></span>
@endslot
@endcomponent

<ul class=" flex border-b mb-8">
    <li class=""><a href='{{ url("/{$project->name}/links/{$link->domain}/{$link->name}") }}' class="bg-white inline-block px-4 py-2 text-indigo-600">Statistics</a></li>
    <li class=""><a href='{{ url("/{$project->name}/links/{$link->domain}/{$link->name}/rules") }}' class="bg-white inline-block px-4 py-2 text-indigo-600">Rules</a></li>
    <li class="-mb-px"><span class="bg-white inline-block px-4 py-2 border-l border-r border-t rounded-t">Edit</span></li>
</ul>

@component('components.form')
@slot('action', url("/{$project->name}/links/{$link->domain}/{$link->name}"))
@slot('method', 'PUT')
@slot('button', 'Update')
<div class="w-full mb-6">
    <label for="url" class="input-label">URL</label>
    <input class="input-text @error('url') input-invalid @enderror" id="url" type="text" name="url" placeholder="Paste your original URL here" value ="{{ old('url') ?? $link->url }}">
    @error('url')
    <span class="input-error" role="alert">{{ $message }}</span>
    @enderror
</div>
@endcomponent

<div class="mt-12 relative">
    <h3 class="text-lg font-semibold mb-6">Delete Link</h3>
    This action is permanent and cannot be reversed. <a class="text-indigo-600 cursor-pointer" id="show-delete">Click here to delete link</a>. 
    <div class="absolute z-50 shadow mx-4 p-4 top-0 bg-white rounded modal hidden" id="delete">
        <span class="input-label">Warning</span>
        <div>
            You're about to delete <span class="font-semibold">{{ $link->domain.'/'.$link->name }}</span>, do you want to proceed?
            <div class="mt-8">
                <form action='{{ url("/{$project->name}/links/{$link->domain}/{$link->name}") }}' method="POST" class="w-full max-w-lg">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn-danger">Proceed</button>
                    <span class="inline-block ml-4 py-1 cursor-pointer" id="hide-delete">cancel</span>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mt-12">
    <a href='{{ url($project->name) }}' class="text-indigo-600 border-b-2 border-dotted">See your other links.</a>
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
