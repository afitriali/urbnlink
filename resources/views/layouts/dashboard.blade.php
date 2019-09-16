<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="text-gray-900 break-words">
        <div class="max-w-lg mx-auto px-6 mb-8">
            <div class="flex items-center mt-4 mb-8">
                <div class="flex-auto leading-relaxed">
                    @yield('navigation')
                </div>
                <div class="flex-none mx-4">
                    @yield('create_button')
                </div>
                <div class="flex-none">
                    @auth
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-2 py-1 border-2 rounded"><i data-feather="menu" class="inline-block"></i></button>
                    <div class="hidden">
                        <div class="rounded-full overflow-hidden w-8 h-8 shadow" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <img src="{{ Auth::user()->gravatar }}?d=identicon" />
                        </div>
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
            @yield('scripts')
            <script>
feather.replace()
            </script> 
        </div>
    </body>
</html>
