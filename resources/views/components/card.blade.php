<a href="{{ $url }}">
    <li class="group block mb-4 p-4 shadow rounded hover:bg-indigo-100">
        <h3 class="text-lg font-semibold group-hover:text-indigo-900">{{ $name }}</h3>
        <p class="text-sm text-gray-500 font-light mb-4 group-hover:text-indigo-900 truncate">{{ $description }}</p>
        <p class="text-xs text-gray-500 group-hover:text-indigo-900 capitalize">
        {{ $slot }}
        </p>
    </li>
</a>
