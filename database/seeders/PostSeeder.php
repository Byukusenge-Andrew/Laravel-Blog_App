<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        if (!$admin) {
            $this->command->error('Admin user not found. Please run AdminUserSeeder first.');
            return;
        }

        $posts = [
            [
                'title' => 'Getting Started with Laravel',
                'content' => '<p>Laravel is a web application framework with expressive, elegant syntax. Weve already laid the foundation — freeing you to create without sweating the small things.</p><p>Laravel is accessible, powerful, and provides tools required for large, robust applications.</p>',
                'published' => true,
            ],
            [
                'title' => 'The Power of Tailwind CSS',
                'content' => '<p>Tailwind CSS is a utility-first CSS framework packed with classes like flex, pt-4, text-center and rotate-90 that can be composed to build any design, directly in your markup.</p><p>Its a different way of writing CSS that can speed up your development process.</p>',
                'published' => true,
            ],
            [
                'title' => 'Working with APIs in Laravel',
                'content' => '<p>Laravel makes it incredibly easy to build robust APIs. With built-in support for API authentication, rate limiting, and more, Laravel gives you the tools you need to build powerful APIs.</p><p>In this post, well explore how to create a RESTful API using Laravel Sanctum.</p>',
                'published' => true,
            ],
        ];

        foreach ($posts as $postData) {
            Post::create([
                'user_id' => $admin->id,
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'content' => $postData['content'],
                'published' => $postData['published'],
            ]);
        }

        $this->command->info('Sample blog posts created successfully.');
    }
}
