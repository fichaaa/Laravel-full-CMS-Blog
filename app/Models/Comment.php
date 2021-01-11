<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $fillable = [
        'content',
        'user_id'
    ];


    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public static function boot()
    {   
        parent::boot();

        static::creating(function (Comment $comment)
        {  
            Cache::tags(['post'])->forget("post-{$comment->commentable_id}");
            Cache::tags(['post'])->forget("post-most-commented");
        });
    }

}
