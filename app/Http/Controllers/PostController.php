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
        $posts = Post::where('published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified post.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}
