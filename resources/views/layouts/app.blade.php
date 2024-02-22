<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <header class="bg-gray-800 text-white w-full h-16 flex items-center justify-between fixed top-0 z-10">
            <h1 class="text-lg ml-4"><a href="{{ route('home') }}"">{{ config('app.name') }}</a></h1>
            <label for="menuToggle" class="md:hidden mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="h-8 w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
        </header>
    
        <input type="checkbox" id="menuToggle" class="hidden md:block">
        <div class="menu-container fixed top-16 left-0 w-1/5 bg-gray-100 p-4 z-10">
            <nav class="menu">
                <ul>
                    <li><a href="#" class="block p-2 hover:bg-gray-300">Departments</a></li>
                    <li><a href="#" class="block p-2 hover:bg-gray-300">Users</a></li>
                </ul>
            </nav>
        </div>
    
        <div class="main-content">
            @yield('content')
        </div>
    </body>
</html>
