<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        if($this->command->confirm('Do you want to refresh the database')){
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }

        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
            PostTagSeeder::class
        ]);        


        Cache::tags(['post'])->flush();
        
    }
}
