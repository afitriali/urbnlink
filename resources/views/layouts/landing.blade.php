<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <script src="{{ asset('js/Chart.min.js') }}"></script>
        <script src="{{ asset('js/feather.min.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="text-gray-900 break-words">
        <div class="max-w-lg mx-auto">
            <div class="flex items-center mt-4 mb-8 mx-6">
                <div class="flex-auto leading-relaxed relative">
                    <a href="{{ config('app.url') }}" class="flex items-center"><h1 class="inline font-light">{{ config('app.name') }}</h1>
                        <span class="inline-block bg-gray-200 text-gray-500 text-xs px-1 ml-1 rounded">alpha</span>
                    </a>
                </div>
                <div class="flex-none">
                    @auth
                    <a href="{{ env('DASHBOARD_URL') }}" class="btn">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="mr-4 py-1">Log In</a>

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
