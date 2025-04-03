<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('layouts.app', 'app-layout');

        // Add reading time calculation
        Str::macro('readingTime', function ($content) {
            $wordCount = str_word_count(strip_tags($content));
            $readingTime = ceil($wordCount / 200); // Average reading speed: 200 words per minute
            return max(1, $readingTime); // Minimum 1 minute
        });
    }
}
