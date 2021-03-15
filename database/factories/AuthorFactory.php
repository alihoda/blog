<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
   
    protected $model = Author::class;

    public function definition()
    {
        return [
            //
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Author $author){
            //
        })->afterCreating(function (Author $author){
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
