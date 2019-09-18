<a href="{{ $url }}">
    <li class="block mb-4 p-4 shadow-lg rounded hover:shadow">
        <h3 class="text-xl text-indigo-600">{{ $name }}</h3>
        <p class="font-light mb-4 truncate">{{ $description }}</p>
        <div class="flex items-center text-xs text-gray-500 capitalize">
        {{ $slot }}
        </div>
    </li>
</a>
