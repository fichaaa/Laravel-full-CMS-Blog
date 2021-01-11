<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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
        $users = User::all();
        
        $commentCount = max((int)$this->command->ask('How Many Comments do you want?', 150), 1);

        $comments = Comment::factory($commentCount)->make();

        $comments->each(function($comment) use($posts,$users){
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = Post::class;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

        $comments = Comment::factory($commentCount)->make();

        $comments->each(function($comment) use($users){
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = User::class;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
