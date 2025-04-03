<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBlogAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $blogAccess = Setting::get('blog_access', 'public');

            if ($blogAccess === 'members_only' && !Auth::check()) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'This blog is only accessible to registered users.'], 403);
                }

                return redirect()->route('login')
                    ->with('message', 'This blog is only accessible to registered users. Please log in or register to continue.');
            }
        } catch (\Exception $e) {
            // If there's an error (like table doesn't exist), default to public access
        }

        return $next($request);
    }
}
