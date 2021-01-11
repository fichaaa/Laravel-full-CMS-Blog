<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Traits\Taggable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes, Taggable;
    
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelation(Builder $query)
    {
        return $query->latest()->withCount('comments')->with('user')->with('tags');
    }

    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();

        // static::addGlobalScope(new LatestScope);

        static::updating(function(Post $post){
            Cache::tags(['post'])->forget("post-{$post->id}");
        });

        static::deleting(function(Post $post){
            Cache::tags(['post'])->forget("post-{$post->id}");
            $post->comments()->delete();
        });

        static::restoring(function(Post $post){
            $post->comments()->restore();
        });
    }
}
