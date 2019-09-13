<a href="{{ $url }}">
    <li class="block mb-4 p-4 shadow-lg rounded hover:shadow">
        <h3 class="text-lg font-semibold text-blue-700">{{ $name }}</h3>
        <p class="text-sm text-gray-500 font-light mb-4 truncate">{{ $description }}</p>
        <p class="text-xs text-gray-500 capitalize">
        {{ $slot }}
        </p>
    </li>
</a>
