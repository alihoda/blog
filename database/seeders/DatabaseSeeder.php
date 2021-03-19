<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\BlogPost;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Want to refresh database?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database is seeded');
        }

        Cache::tags(['blog-post'])->flush();

        $this->call([UserSeeder::class, BlogPostSeeder::class, CommentSeeder::class]);

    }
}
