<?php

namespace App\Listeners;

use App\Models\User;
use App\Jobs\ThrottledMail;
use App\Mail\PostCreatedMail;
use App\Events\PostCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminPostCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostCreatedEvent $event)
    {
        User::isAdmin()->get()
            ->map(function(User $user) use($event)
            {
                ThrottledMail::dispatch(new PostCreatedMail($event->post, $user), $user);
            });
    }
}
