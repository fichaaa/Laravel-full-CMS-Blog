<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable')->withTimestamps()->using(PostTag::class)->as('tagged');
    }

    public function comments()
    {
        return $this->morphedByMany(Post::class, 'taggable')->withTimestamps()->using(PostTag::class)->as('tagged');
    }
}
