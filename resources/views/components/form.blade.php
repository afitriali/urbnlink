<form action="{{ $action }}" method="POST" class="w-full max-w-lg">
    @method($method)
    @csrf
    {{ $slot }}
    <button type="submit" class="btn my-6">Create</button>
</form>
