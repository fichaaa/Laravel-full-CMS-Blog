<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Comment;
use App\Observers\PostObserver;
use App\Events\PostCreatedEvent;
use App\Events\CommentPostedEvent;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Jobs\NotifyAdminPostCreatedJob;
use App\Listeners\CacheSubscriber;
use App\Listeners\NotifyUsersAboutComment;
use App\Listeners\NotifyAdminPostCreatedListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentPostedEvent::class => [
            NotifyUsersAboutComment::class
        ],
        PostCreatedEvent::class => [
            NotifyAdminPostCreatedListener::class
        ]
    ];

    protected $subscribe = [
        CacheSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
