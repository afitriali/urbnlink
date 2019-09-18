<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/Chart.min.js') }}"></script>
        <script src="{{ asset('js/feather.min.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="text-gray-900 break-words">
        <div class="max-w-lg mx-auto px-6 mb-8">
            <div class="flex items-center mt-4 mb-8">
                <div class="flex-auto leading-relaxed">
                    <a href="{{ url('/') }}" class="flex items-center"><h1 class="inline font-light">{{ config('app.name') }}</h1>
                        <span class="inline-block bg-gray-200 text-gray-500 text-xs px-1 ml-1 rounded">alpha</span>
                    </a>
                </div>
                <div class="flex-none mx-4">
                    @yield('create_button')
                </div>
                <div class="flex-none">
                    @auth
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-2 py-1"><i data-feather="menu" class="inline-block text-gray-500"></i></button>
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
            <div class="bg-teal-100 text-teal-900 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">{{ session('success') }}</div>
            @endif
            @if (session('message'))
            <div class="bg-teal-100 text-teal-900 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">{{ session('message') }}</div>
            @endif

            @yield('content')
        </div>

        <div class="max-w-lg mx-auto mt-12">
            <p class="font-light px-6 py-12 bg-teal-300 text-teal-800 leading-relaxed sm:rounded-lg">
            URBN helps you manage your websites, online forms and social media links. Use URBN to grow and find your audience.
            <p>
        </div>

        @yield('scripts')
        <script>
feather.replace()
        </script> 
    </body>
</html>
