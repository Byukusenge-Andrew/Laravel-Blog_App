<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="admin-sidebar w-64 px-4 py-6">
            <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.posts.*') ? 'bg-gray-700' : '' }}">
                            Manage Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700' : '' }}">
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Blog Settings</h1>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-4">Access Control</h2>

                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="radio" id="public" name="blog_access" value="public" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" {{ $blogAccess === 'public' ? 'checked' : '' }}>
                                <label for="public" class="ml-2 block text-sm text-gray-900">
                                    <span class="font-medium">Public Access</span>
                                    <p class="text-gray-500">Anyone can view blog posts without logging in</p>
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="radio" id="members_only" name="blog_access" value="members_only" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" {{ $blogAccess === 'members_only' ? 'checked' : '' }}>
                                <label for="members_only" class="ml-2 block text-sm text-gray-900">
                                    <span class="font-medium">Members Only</span>
                                    <p class="text-gray-500">Only registered users can view blog posts</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
