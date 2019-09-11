<form action="{{ $action }}" method="POST">
    @method($method)
    @csrf
    {{ $slot }}
    <br><button type="submit" class="btn my-8 clear-left">Create</button>
</form>
