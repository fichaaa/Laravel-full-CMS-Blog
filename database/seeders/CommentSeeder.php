<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = Post::all();
        
        $commentCount = max((int)$this->command->ask('How Many Comments do you want?', 150), 1);

        $comments = Comment::factory($commentCount)->make();

        $comments->each(function($comment) use($posts){
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
