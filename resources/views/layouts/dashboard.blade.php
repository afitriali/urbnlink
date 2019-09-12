<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="text-gray-900 break-words">
        <div class="max-w-sm mx-auto px-4">
            <div class="flex mt-4 mb-8">
                <div class="flex-auto mt-1 leading-relaxed">
                    @yield('navigation')
                </div>
                <div class="flex-none">
                    @auth
                    <div class="flex-none rounded-full overflow-hidden w-8 h-8 mr-0 shadow" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ Auth::user()->gravatar }}?d=identicon" />
                    </div>
                    <div class="hidden">
                        Hi, {{ Auth::user()->name }}</br>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @endauth

            @if (session('success'))
            <div class="bg-green-100 text-green-400 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">{{ session('success') }}</div>
            @endif
            @if (session('message'))
            <div class="bg-blue-100 text-blue-400 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">{{ session('message') }}</div>
            @endif

            @yield('content')
        </div>
    </body>
</html>
