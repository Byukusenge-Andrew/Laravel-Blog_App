<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Transition effects */
        .nav-link {
            transition: all 0.2s ease-in-out;
        }

        /* Pulse animation for notifications */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-indigo-900 to-indigo-800 min-h-screen flex flex-col fixed shadow-xl z-10">
            <!-- Logo Area -->
            <div class="px-6 py-6 flex items-center justify-between border-b border-indigo-700/50">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <h1 class="text-white text-xl font-bold tracking-tight">{{ config('app.name', 'Laravel') }}</h1>
                </a>

                <!-- Mobile menu button (hidden on desktop) -->
                <button type="button" class="md:hidden text-indigo-200 hover:text-white">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 py-6 px-4 overflow-y-auto sidebar-scroll">
                <div class="space-y-1">
                    <p class="px-3 text-xs font-semibold text-indigo-200 uppercase tracking-wider">Main</p>

                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700 text-white shadow-sm' : 'text-indigo-100 hover:bg-indigo-700/50' }}">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-300' : 'text-indigo-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <p class="mt-6 px-3 text-xs font-semibold text-indigo-200 uppercase tracking-wider">Content</p>

                    <!-- Posts -->
                    <a href="{{ route('admin.posts.index') }}"
                       class="nav-link group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.posts.*') ? 'bg-indigo-700 text-white shadow-sm' : 'text-indigo-100 hover:bg-indigo-700/50' }}">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.posts.*') ? 'text-indigo-300' : 'text-indigo-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Posts
                        <span class="ml-auto bg-indigo-600 text-xs px-2 py-0.5 rounded-full">
                            {{ \App\Models\Post::count() }}
                        </span>
                    </a>

                    <!-- Create New Post (Quick Action) -->
                    <a href="{{ route('admin.posts.create') }}"
                       class="nav-link group flex items-center px-3 py-2 text-xs font-medium rounded-lg ml-6 {{ request()->routeIs('admin.posts.create') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:bg-indigo-700/30' }}">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Post
                    </a>

                    <p class="mt-6 px-3 text-xs font-semibold text-indigo-200 uppercase tracking-wider">Administration</p>

                    <!-- Settings -->
                    <a href="{{ route('admin.settings.index') }}"
                       class="nav-link group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-700 text-white shadow-sm' : 'text-indigo-100 hover:bg-indigo-700/50' }}">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.settings.*') ? 'text-indigo-300' : 'text-indigo-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                    </a>

                    <!-- View Site -->
                    <a href="{{ url('/') }}" target="_blank"
                       class="nav-link group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-indigo-100 hover:bg-indigo-700/50 mt-6">
                        <svg class="mr-3 h-5 w-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        View Site
                    </a>
                </div>
            </nav>

            <!-- User Profile Section -->
            <div class="px-4 py-4 border-t border-indigo-700/50 bg-indigo-800/50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-9 w-9 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold text-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3 min-w-0 flex-1">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                            <div class="ml-2 flex-shrink-0 relative">
                                <button type="button" class="text-indigo-300 hover:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p class="text-xs text-indigo-300 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- User Menu (can be expanded with JavaScript) -->
                <div class="mt-3 space-y-1">
                    <a href="#" class="block px-3 py-1 text-sm text-indigo-200 hover:text-white hover:bg-indigo-700 rounded-md">
                        Your Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-1 text-sm text-indigo-200 hover:text-white hover:bg-indigo-700 rounded-md">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Navigation -->
            <div class="bg-white shadow-sm sticky top-0 z-10">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="text-2xl font-bold leading-tight text-gray-900">
                        @yield('header', 'Dashboard')
                    </h2>

                    <!-- Quick Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-64 rounded-full pl-10 pr-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <div class="absolute left-3 top-2.5">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <button type="button" class="relative p-1 text-gray-500 hover:text-indigo-600 focus:outline-none">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500 pulse"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="py-8 px-6">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm relative" role="alert">
                        <div class="flex">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Success!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="absolute top-0 right-0 mt-4 mr-4 text-green-700" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm relative" role="alert">
                        <div class="flex">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Error!</p>
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" class="absolute top-0 right-0 mt-4 mr-4 text-red-700" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </p>
                    <p class="text-sm text-gray-500">
                        Version 1.0.0
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
