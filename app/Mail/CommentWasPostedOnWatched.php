<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentWasPostedOnWatched extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $comment;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, User $user)
    {
        $this->comment = $comment;
        $this->user = $user;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Someone posted on post you watched - {$this->comment->commentable->title}";
        return $this->subject($subject)->markdown('emails.posts.comment-posted-on-watched');
    }
}
