<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use function Symfony\Component\String\b;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class PostTag extends MorphPivot
{
    use HasFactory;

    protected $table = 'taggables';


    public static function boot()
    {
        parent::boot();


        static::creating(function (PostTag $postTag) {
            if($postTag->taggable_type === Post::class){
                Cache::tags(['post'])->forget("post-{$postTag->taggable_id}");
            }
         });

         static::deleting(function (PostTag $postTag){
            if($postTag->taggable_type === Post::class){
                Cache::tags(['post'])->forget("post-{$postTag->taggable_id}");
            }
         });
    }
}
