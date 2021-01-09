<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($id)
    {
        $posts = Tag::findOrFail($id)->posts()->latestWithRelation()->get();
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

}
