<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SetupBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the blog application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up the blog application...');

        // Add is_admin column to users table if it doesn't exist
        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'is_admin')) {
            $this->info('Adding is_admin column to users table...');
            Schema::table('users', function ($table) {
                $table->boolean('is_admin')->default(false)->after('password');
            });
            $this->info('is_admin column added successfully.');
        }

        // Create posts table if it doesn't exist
        if (!Schema::hasTable('posts')) {
            $this->info('Creating posts table...');
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2023_10_03_000000_create_posts_table_if_not_exists.php',
            ]);
            $this->info('Posts table created successfully.');
        }

        // Create admin user
        $this->info('Creating admin user...');
        Artisan::call('db:seed', [
            '--class' => 'AdminUserSeeder',
        ]);

        $this->info('Blog setup completed successfully!');
        $this->info('You can now log in with:');
        $this->info('Email: admin@example.com');
        $this->info('Password: password');

        return Command::SUCCESS;
    }
}
