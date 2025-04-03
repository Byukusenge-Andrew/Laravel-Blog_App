<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Andre.Blog') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center">
                            <x-application-logo class="block h-9 w-auto fill-current text-indigo-600" />
                            <span class="ml-3 text-xl font-bold text-gray-900">{{ config('app.name', 'Andre.Blog') }}</span>
                        </a>
                        <nav class="hidden space-x-8 sm:ml-10 sm:flex">
                            <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('/') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                Home
                            </a>
                            <a href="{{ route('posts.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('posts.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                Blog
                            </a>
                        </nav>
                    </div>

                    <div class="flex items-center">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out">
                                    <span class="mr-2">{{ Auth::user()->name }}</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    @if(Auth::user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Admin Dashboard
                                        </a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Log in</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm font-medium text-white bg-indigo-600 py-2 px-4 rounded-md hover:bg-indigo-700">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200 py-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-8 md:mb-0">
                        <a href="{{ url('/') }}" class="flex items-center">
                            <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                            <span class="ml-3 text-xl font-bold text-gray-900">{{ config('app.name', 'Laravel Blog') }}</span>
                        </a>
                        <p class="mt-4 text-gray-600 max-w-xs">
                            Share your thoughts and ideas with the world through our blogging platform.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Navigation</h3>
                            <ul class="mt-4 space-y-2">
                                <li><a href="{{ url('/') }}" class="text-gray-600 hover:text-indigo-600">Home</a></li>
                                <li><a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-indigo-600">Blog</a></li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Account</h3>
                            <ul class="mt-4 space-y-2">
                                @guest
                                    <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Login</a></li>
                                    <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-indigo-600">Register</a></li>
                                @else
                                    <li><a href="{{ route('logout') }}" class="text-gray-600 hover:text-indigo-600" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-8 md:flex md:items-center md:justify-between">
                    <div class="text-center text-gray-500 text-sm">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel Blog') }}. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
