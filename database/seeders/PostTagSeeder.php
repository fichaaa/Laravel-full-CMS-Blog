<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $posts = Post::all();
        
        $tagMin = max((int)$this->command->ask('How Many tags do you want?', 0), 0);

        $tagMax = min((int)$this->command->ask('How Many tags do you want?', 5), 5);

        $posts->each( function($post) use($tagMin,$tagMax){
            $random = random_int($tagMin,$tagMax);
            $tags = Tag::inRandomOrder()->take($random)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
