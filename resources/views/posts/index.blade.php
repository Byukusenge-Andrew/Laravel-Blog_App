<x-app-layout>
    <div class="bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Blog Posts</h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Explore our collection of articles and insights
                </p>
            </div>

            <div class="mt-12 max-w-lg mx-auto grid gap-8 lg:grid-cols-2 lg:max-w-none">
                @forelse($posts as $post)
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <a href="{{ route('posts.show', $post->slug) }}" class="block">
                                    <h2 class="text-xl font-semibold text-gray-900 hover:text-indigo-600">{{ $post->title }}</h2>
                                    <p class="mt-3 text-base text-gray-500">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="sr-only">{{ $post->user->name }}</span>
                                    <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center">
                                        <span class="text-white font-medium">{{ substr($post->user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <time datetime="{{ $post->created_at->format('Y-m-d') }}">{{ $post->created_at->format('M d, Y') }}</time>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>{{ Str::readingTime($post->content) }} min read</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    Read more <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No posts available</h3>
                        <p class="mt-1 text-sm text-gray-500">Check back later for new content.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
