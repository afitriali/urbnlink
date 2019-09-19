<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <script src="{{ asset('js/Chart.min.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="text-gray-900 break-words">
        <div class="max-w-lg mx-auto px-6 mb-8 relative">
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
                    <button class="px-2 py-1" id="show-menu"><i data-feather="menu" class="inline-block text-gray-500"></i></button>
                </div>
            </div>
            <div class="absolute z-50 shadow top-0 right-0 mx-4 p-4 bg-white rounded modal hidden" id="menu" onclick="toggleActive(this)">
                <span class="input-label">Logged in as</span>
                <span class="block font-bold">{{ Auth::user()->name }}</span>
                <span class="block text-sm border-b pb-4">{{ Auth::user()->email }}</span>
                <span class="block text-sm border-b pb-4 mt-4">
                    <a class="block mt-4 flex text-sm items-center text-gray-500">
                        <i data-feather="settings" class="inline h-4 w-4"></i><span class="ml-2">{{ __('Settings') }}</span>
                    </a>
                </span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block mt-4 flex text-sm items-center">
                    <i data-feather="log-out" class="inline h-4 w-4"></i><span class="ml-2">{{ __('Logout') }}</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            @if (session('success'))
            <div class="bg-teal-100 text-teal-900 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">{{ session('success') }}</div>
            @endif
            @if (session('message'))
            <div class="bg-teal-100 text-teal-900 text-sm font-light rounded-lg mb-6 p-4 tracking-wide">{{ session('message') }}</div>
            @endif

            @yield('content')
        </div>

        <div class="max-w-lg mx-auto mt-12 p-6 bg-teal-300 text-teal-800 leading-relaxed sm:rounded-lg">
            <div class="flex items-center"> 
                <span class="font-light mr-1">Built with</span>
                <svg class="feather h-4 w-4"><use xlink:href="{{ url('/img') }}/feather-sprite.svg#heart"/></svg>
                <span class="font-light ml-1">by <a target="_blank" rel="noopener noreferrer" href="https://twitter.com/afitriali" class="border-b-2 border-dotted border-teal-900 font-semibold">@afitriali</a>.</span>
            </div>
            <span class="inline-block font-light mt-1">Illustrations by <a target="_blank" rel="noopener noreferrer" href="https://icons8.com" class="border-b-2 border-dotted border-teal-900">Icons 8</a>.</span>
        </div>

        <script>
var menu = document.getElementById("menu");
var burger = document.getElementById("show-menu");

burger.onclick = function() {
menu.style.display = "block";
};

menu.onclick = function() {
menu.style.display = "none";
};

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
        @yield('scripts')
    </body>
</html>
