<?php

namespace App\Listeners;

use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use App\Events\CommentPostedEvent;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\NotifyUsersPostWasCommented;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersAboutComment
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPostedEvent $event)
    {
                
        ThrottledMail::dispatch(new CommentPosted($event->comment), $event->comment->commentable->user)->onQueue('low');

        NotifyUsersPostWasCommented::dispatch($event->comment)->onQueue('high');
    }
}
