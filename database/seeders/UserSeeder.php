<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = max((int)$this->command->ask('How Many Users do you want?', 20), 1);
        User::factory()->suspended()->create();
        User::factory($userCount)->create();
    }
}
