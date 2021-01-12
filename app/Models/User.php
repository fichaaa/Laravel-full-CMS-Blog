<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const LOCALES = [
        'en' => 'English',
        'es' => 'Spanish',
        'de' => 'Detusch'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsOn()
    {
        return $this->morphMany(Comment::class,'commentable')->latest();
    }
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function scopeMostActiveUsers(Builder $query)
    {
        return $query->withCount('posts')->orderBy('posts_count', 'desc');
    }

    public function scopeMostActiveUsersLastMonth(Builder $query)
    {
        return $query->withCount(['posts' => function($query) {
          $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);  
        }])->has('posts', '>=', 2)->orderBy('posts_count', 'desc');
    }

    public function scopeThatHasCommented(Builder $query, Post $post)
    {
        return $query->whereHas('comments', function(Builder $query) use($post) {
            return $query->where('commentable_id','=', $post->id)
                        ->where('commentable_type','=', Post::class);
        });
    }

    public function scopeIsAdmin(Builder $query)
    {
        return $query->where('is_admin',true);
    }
}

