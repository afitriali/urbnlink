<form action="{{ $action }}" method="POST" class="w-full max-w-lg">
    @method($method)
    @csrf
    {{ $slot }}
    <div class="mt-8">
        <button type="submit" class="btn">@isset($button) {{ $button }} @else Create @endisset</button><a href="{{ url()->previous() }}" class="ml-4">cancel </a>
    </div>
</form>
