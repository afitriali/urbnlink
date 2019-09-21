<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - Dynamic URL Shortener</title>
        <meta name="description" content="Make a memorable link, add logics and turn it dynamic.">

        @yield('script_head')
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

            <script>
                (function(f, a, t, h, o, m){
                    a[h]=a[h]||function(){
                        (a[h].q=a[h].q||[]).push(arguments)
                    };
                    o=f.createElement('script'),
                        m=f.getElementsByTagName('script')[0];
                    o.async=1; o.src=t; o.id='fathom-script';
                    m.parentNode.insertBefore(o,m)
                })(document, window, '//cdn.usefathom.com/tracker.js', 'fathom');
                fathom('set', 'siteId', 'ZMCRYJTW');
                fathom('trackPageview');
            </script> 
            @yield('script_body')
        </div>
    </body>
</html>
