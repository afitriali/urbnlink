<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="text-gray-900 break-words">
        <div class="max-w-lg mx-auto">
            <div class="flex items-center mt-4 mb-8 mx-6">
                <div class="flex-auto leading-relaxed relative">
                    <a href="{{ config('app.url') }}"><h1 class="inline text-lg tracking-wider">{{ config('app.name') }}</h1>
                        <span class="inline-block bg-blue-100 text-blue-400 text-xs px-1 rounded">beta</span>
                    </a>
                </div>
                <div class="flex-none">
                    @auth
                    <a href="{{ env('DASHBOARD_URL') }}" class="inline-block">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="mr-4">Log In</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn">Sign Up</a>
                    @endif
                    @endauth
                </div>
            </div>

            @yield('content')
            @yield('scripts')
            <script>
                feather.replace()
            </script> 
        </div>
    </body>
</html>
