@extends('layouts.dashboard')

@section('content')
    @component('components.header')
        @slot('title') {{ $project->name }} @endslot
        @slot('sub_title') {{ $project->description }} @endslot
    @endcomponent

    <ul class=" flex border-b mb-8">
        <li class=""><a href='{{ url($project->name) }}' class="inline-block px-4 py-2 text-indigo-600">Links</a></li>
        <li class=""><a href='{{ url("/{$project->name}/pages") }}' class="inline-block px-4 py-2 text-indigo-600">Pages</a></li>
        <li class="-mb-px"><span class=" bg-white inline-block px-4 py-2 border-l border-r border-t rounded-t">Settings</span></li>
    </ul>

    @component('components.form')
        @slot('action') {{ url($project->name) }} @endslot
        @slot('method') PUT @endslot
        @slot('button') Update @endslot
        <div class="w-full mb-6">
            <label for="name" class="input-label">Name</label>
            <input class="input-text @error('name') input-invalid @enderror" id="name" type="text" name="name" max="40" placeholder="Project Name" value ="{{ $project->name }}">
            @error('name')
            <span class="input-error" role="alert">{{ $message }}</span>
        @enderror
        </div>

        <div class="w-full mb-6">
            <label for="description" class="input-label">Description</label>
            <input class="input-text @error('description') input-invalid @enderror" id="description" type="text" name="description" max="160" placeholder="Give your project a brief description" value ="{{ $project->description }}">
            @error('description')
            <span class="input-error" role="alert">{{ $message }}</span>
        @enderror
        </div>
    @endcomponent

    <div class="mt-12">
        <h3 class="text-lg font-semibold mb-6">Domains</h3>
        @foreach ($domains as $domain)
            <form action='{{ url("/{$project->name}/domains/{$domain->name}/default") }}' method="POST" class="w-full max-w-lg">
                @csrf
                <label class="input-label"><span class="text-gray-900 font-semibold">{{ $domain->name }}</span> default link</label>
                <div class="relative">
                    <select class="input-text pr-8" name="link" onchange="this.form.submit()">
                        <option value="" default></option>
                        @foreach ($links as $link)
                            <option value="{{ $link->id }}" <?= $domain->default_link_id === $link->id ? 'selected="selected"' : '' ?>>{{ $link->domain.'/'.$link->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </form>
        @endforeach
    </div>

    <div class="mt-12 relative">
        <h3 class="text-lg font-semibold mb-6">Delete Project</h3>
        This action is permanent and cannot be reversed. All links within this project will be deleted. <a class="text-indigo-600 cursor-pointer" id="show-delete">Click here to delete project</a>.
        <div class="absolute z-50 shadow mx-4 p-4 top-0 bg-white rounded modal hidden" id="delete">
            <span class="input-label">Warning</span>
            <div>
                You're about to delete <span class="font-semibold">{{ $project->name }}</span> project, do you want to proceed?
                <div class="mt-8">
                    <form action='{{ url($project->name) }}' method="POST" class="w-full max-w-lg">
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
        <a href='{{ url("/") }}' class="text-indigo-600 border-b-2 border-dotted">See your other projects.</a>
    </div>
@endsection

@section('script_body')
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
