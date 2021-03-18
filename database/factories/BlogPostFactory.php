<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    
    protected $model = BlogPost::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(4, true),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }

    public function withUser($userId = null)
    {
        return $this->state([
            'user_id' => $userId ?? $this->user()->id,
        ]);
    }
}
