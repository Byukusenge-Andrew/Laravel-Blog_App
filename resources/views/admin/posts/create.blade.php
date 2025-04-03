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
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Create Post</h1>
                <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:underline">
                    ← Back to Posts
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea name="content" id="content" rows="10" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="published" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" {{ old('published') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Published</span>
                        </label>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Visibility</label>
                        <div class="mt-2 space-y-2">
                            <div class="flex items-center">
                                <input id="visibility_public" name="visibility" type="radio" value="public" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" checked>
                                <label for="visibility_public" class="ml-2 block text-sm text-gray-900">
                                    Public
                                    <p class="text-xs text-gray-500">Visible to everyone, including non-logged in visitors</p>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="visibility_members_only" name="visibility" type="radio" value="members_only" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="visibility_members_only" class="ml-2 block text-sm text-gray-900">
                                    Members Only
                                    <p class="text-xs text-gray-500">Only visible to logged-in users</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
