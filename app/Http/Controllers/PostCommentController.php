<?php

namespace App\Http\Controllers;

use App\Events\CommentPostedEvent;
use App\Models\Post;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use App\Http\Requests\StoreComment;
use Illuminate\Support\Facades\Mail;
use App\Jobs\NotifyUsersPostWasCommented;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(Post $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
                'content' => $request->input('comment'),
                'user_id' => $request->user()->id
        ]);

        event(new CommentPostedEvent($comment));

        return redirect()->back()->withStatus('Comment Was added');
    }
}
