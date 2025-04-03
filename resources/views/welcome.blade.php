<x-app-layout>
    <div class="relative bg-gradient-to-r from-indigo-700 to-purple-700">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover mix-blend-overlay opacity-40" src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Blog background">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 to-purple-700 mix-blend-multiply opacity-60"></div>
        </div>

        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Welcome to <span class="text-indigo-200">Andre.Blog</span>
            </h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl leading-relaxed">
                Discover the latest articles and insights from our team of experts. Dive into a world of knowledge and inspiration.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 shadow-md transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                    Browse Articles
                </a>

                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-md transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create New Post
                        </a>
                    @endif
                @endauth
            </div>

            @auth
                @if(Auth::user()->is_admin)
                    <div class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 mb-6 mx-auto max-w-7xl">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">
                                    Blog access is currently set to: <strong>
                                    @php
                                        try {
                                            $access = \App\Models\Setting::get('blog_access', 'public');
                                            echo $access === 'public' ? 'Public' : 'Members Only';
                                        } catch (\Exception $e) {
                                            echo 'Public';
                                        }
                                    @endphp
                                    </strong>
                                    <a href="{{ route('admin.settings.index') }}" class="font-medium underline">Change settings</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">FEATURED CONTENT</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl lg:text-5xl">
                    Latest Articles
                </p>
                <p class="mt-5 max-w-2xl mx-auto text-xl text-gray-500">
                    Check out our most recent publications
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach(\App\Models\Post::where('published', true)->latest()->take(3)->get() as $post)
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden transition duration-300 ease-in-out hover:shadow-xl hover:transform hover:-translate-y-1">
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <a href="{{ route('posts.show', $post->slug) }}" class="block">
                                    <p class="text-sm font-medium text-indigo-600">
                                        <time datetime="{{ $post->created_at->format('Y-m-d') }}">{{ $post->created_at->format('M d, Y') }}</time>
                                    </p>
                                    <h3 class="mt-2 text-xl font-semibold text-gray-900 group-hover:text-indigo-600">{{ $post->title }}</h3>
                                    <p class="mt-3 text-base text-gray-500">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="sr-only">{{ $post->user->name }}</span>
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-white font-medium">{{ substr($post->user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <span>{{ Str::readingTime($post->content) }} min read</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 flex items-center">
                                    Read more
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150 ease-in-out">
                    View All Articles
                </a>
            </div>
        </div>
    </div>
 @guest
    <div class="bg-indigo-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Why Join Our Community?
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg text-gray-500">
                        Become part of our growing community of readers and writers. Share your thoughts, engage with others, and stay updated with the latest content.
                    </p>
                    <div class="mt-8 space-y-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-500">Comment on articles and engage with authors</p>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-500">Get personalized content recommendations</p>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base text-gray-500">Stay updated with email notifications</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 lg:mt-0">

                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-8 sm:p-10">
                                <h3 class="text-2xl font-extrabold text-gray-900 text-center">Join Our Community</h3>
                                <div class="mt-8 flex flex-col space-y-4">
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Sign up for free
                                    </a>
                                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50">
                                        Log in
                                    </a>
                                </div>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
    @else
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-8 sm:p-10">
                                <h3 class="text-2xl font-extrabold text-gray-900 text-center">Welcome Back!</h3>
                                <p class="mt-4 text-center text-gray-500">Thanks for being part of our community, {{ Auth::user()->name }}.</p>
                                <div class="mt-8 flex justify-center">
                                    <a href="{{ route('posts.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Explore Latest Content
                                    </a>
                                </div>
                            </div>
                        </div>
    @endguest
</x-app-layout>
