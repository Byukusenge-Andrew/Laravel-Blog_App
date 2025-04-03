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
            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Posts</h2>
                    <p class="text-3xl font-bold">{{ \App\Models\Post::count() }}</p>
                    <p class="text-gray-600 mt-2">Total posts</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:underline">View all posts →</a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Published</h2>
                    <p class="text-3xl font-bold">{{ \App\Models\Post::where('published', true)->count() }}</p>
                    <p class="text-gray-600 mt-2">Published posts</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Drafts</h2>
                    <p class="text-3xl font-bold">{{ \App\Models\Post::where('published', false)->count() }}</p>
                    <p class="text-gray-600 mt-2">Draft posts</p>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Recent Posts</h2>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach(\App\Models\Post::orderBy('created_at', 'desc')->take(5)->get() as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:underline">{{ $post->title }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $post->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($post->published)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Draft</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
