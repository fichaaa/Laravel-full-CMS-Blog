<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreComment;

class UserCommentController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(User $user, StoreComment $request)
    {
        $user->commentsOn()->create([
            'content' => $request->input('comment'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->back()->withStatus('Comment was added');
    }
}
