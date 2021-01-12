<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public function updating(Post $post){
        Cache::tags(['post'])->forget("post-{$post->id}");
    }

    public function deleting(Post $post){
        Cache::tags(['post'])->forget("post-{$post->id}");
        $post->comments()->delete();
    }

    public function restoring(Post $post)
    {
        $post->comments()->restore();
    }
}
