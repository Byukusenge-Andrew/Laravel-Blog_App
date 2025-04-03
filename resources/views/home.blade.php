<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl font-bold mb-6">Welcome to Our Blog</h1>
            <p class="text-lg mb-8">Discover the latest articles and insights from our team.</p>

            <div class="flex justify-center">
                <a href="{{ route('posts.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium hover:bg-blue-700 transition duration-200">
                    Browse Articles
                </a>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6 text-center">Featured Posts</h2>

            @php
                $featuredPosts = \App\Models\Post::where('published', true)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
            @endphp

            @if($featuredPosts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredPosts as $post)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-blue-600">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ $post->created_at->format('F j, Y') }} · {{ $post->user->name }}
                                </p>
                                <p class="text-gray-700 mb-4">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:underline">
                                    Read more →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">No posts available yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
