<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::visibleTo(auth()->user())
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified post.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->visibleTo(auth()->user())
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}
