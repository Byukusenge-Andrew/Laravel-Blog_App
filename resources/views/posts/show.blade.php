<x-app-layout>
    <article class="py-16 bg-white overflow-hidden">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:text-indigo-500 flex items-center">
                    <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Posts
                </a>
            </div>

            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">{{ $post->title }}</h1>
                <div class="mt-4 flex items-center justify-center">
                    <div class="flex-shrink-0">
                        <span class="sr-only">{{ $post->user->name }}</span>
                        <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center">
                            <span class="text-white font-medium">{{ substr($post->user->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-3 text-left">
                        <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                        <div class="flex space-x-1 text-sm text-gray-500">
                            <time datetime="{{ $post->created_at->format('Y-m-d') }}">{{ $post->created_at->format('F j, Y') }}</time>
                            <span aria-hidden="true">&middot;</span>
                            <span>{{ Str::readingTime($post->content) }} min read</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 prose prose-indigo prose-lg mx-auto">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="mt-16 border-t border-gray-200 pt-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Share this post:</span>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>

                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                Edit Post
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </article>

    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl font-extrabold text-gray-900 mb-8">More Articles</h2>
                <div class="grid gap-8 md:grid-cols-2">
                    @foreach(\App\Models\Post::where('published', true)->where('id', '!=', $post->id)->latest()->take(2)->get() as $relatedPost)
                        <div class="flex flex-col rounded-lg shadow-sm overflow-hidden">
                            <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <a href="{{ route('posts.show', $relatedPost->slug) }}" class="block">
                                        <h3 class="text-lg font-semibold text-gray-900 hover:text-indigo-600">{{ $relatedPost->title }}</h3>
                                        <p class="mt-3 text-sm text-gray-500">{{ Str::limit(strip_tags($relatedPost->content), 100) }}</p>
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('posts.show', $relatedPost->slug) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        Read more <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
