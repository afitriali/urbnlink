<a href="{{ $url }}">
    <li class="block mb-4 p-4 shadow-lg rounded hover:shadow">
        <h3 class="text-lg text-blue-400">{{ $name }}</h3>
        <p class="text-sm text-gray-500 font-light mb-4 truncate">{{ $description }}</p>
        <div class="flex items-center text-xs text-gray-500 capitalize">
        {{ $slot }}
        </div>
    </li>
</a>
