<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Comment;
use App\Jobs\ThrottledMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\CommentWasPostedOnWatched;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifyUsersPostWasCommented implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::thatHasCommented($this->comment->commentable)->get()
            ->filter(function(User $user) {
                return $user->id !== $this->comment->user_id && $user->id !== $this->comment->commentable->user_id;
            })->map(function(User $user) {
                    ThrottledMail::dispatch(new CommentWasPostedOnWatched($this->comment, $user), $user);
            });

    }
}
