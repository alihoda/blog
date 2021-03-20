<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogPostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if ($tagCount === 0) {
            $this->command->info('No tags found, skipping assigning tags to posts');
            return;
        }

        $countMin = (int)$this->command->ask('Minimum tags on blog posts?', 1);
        $countMax = min((int)$this->command->ask('Maximum tags on blog posts?', $tagCount), $tagCount);

        BlogPost::all()->each(function (BlogPost $post) use ($countMin, $countMax) {
            $count = random_int($countMin, $countMax);
            $tags = Tag::inRandomOrder()->take($count)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
