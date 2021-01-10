<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StoreComment;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(Post $post, StoreComment $request)
    {
        $post->comments()->create([
                'content' => $request->input('comment'),
                'user_id' => $request->user()->id
        ]);

        return redirect()->back()->withStatus('Comment Was added');
    }
}
