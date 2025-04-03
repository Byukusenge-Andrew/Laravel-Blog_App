<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the blog access setting
        $blogAccess = \App\Models\Setting::get('blog_access', 'public');

        // If blog is public, allow access
        if ($blogAccess === 'public') {
            return $next($request);
        }

        // If blog is members only and user is not logged in, redirect to login
        if ($blogAccess === 'members_only' && !auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'You need to log in to access the blog.');
        }

        // User is logged in, allow access
        return $next($request);
    }
}
