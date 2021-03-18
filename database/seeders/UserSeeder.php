<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = max((int)$this->command->ask('How many users would you like?', 10), 1);

        User::factory()->userAdmin()->create();
        User::factory($userCount)->create();
    }
}
