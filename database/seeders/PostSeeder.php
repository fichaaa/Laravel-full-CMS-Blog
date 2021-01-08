<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        
        $postCount = max((int)$this->command->ask('How Many Posts do you want?', 50), 1);

        $posts = Post::factory($postCount)->make();

        $posts->each(function($post) use($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
