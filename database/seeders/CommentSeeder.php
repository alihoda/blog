<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        $users = User::all();

        if ($posts->count() === 0) {
            $this->command->info('There is no posts, so no comment added!');
            return;
        }
        $commentCount = (int)$this->command->ask('How many comments would you like?', 75);

        Comment::factory($commentCount)->make()->each(function ($comment) use ($posts, $users) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
