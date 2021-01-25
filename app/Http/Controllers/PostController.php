<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Services\Counter;
use App\Facades\CounterFacade;
use App\Events\PostCreatedEvent;
use App\Http\Requests\StorePost;
use App\Contracts\CounterContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latestWithRelation()->get();

        return view('posts.index',[
            'posts' => $posts,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('posts.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validate = $request->validated();
        $post = Post::make($validate);
        $post->user_id = $request->user()->id;
        $post->save();

        $post->tags()->sync($request->input('tags'));

        if($request->hasFile('thumbnail')){
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->image()->create([
                'path' => $path
            ]);
        }

        event(new PostCreatedEvent($post));
     
        $request->session()->flash('status', 'Post was created!');

        return redirect()->route('posts.show',['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $post = Cache::tags(['post'])->remember("post-{$id}", 60, function() use($id){
            return Post::with(['tags','comments','user'])->with('comments.user')->findOrFail($id);
    });

        return view('posts.show',[
            'post' => $post,
            'counter' => CounterFacade::increment("post-{$id}", ['post'])
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize($post);

        $tags = Tag::all();

        return view('posts.edit',['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, Post $post)
    {
        $this->authorize($post);
        $post->tags()->sync($request->input('tags'));

        $validate = $request->validated();
        $post->fill($validate);
        $post->save();

        if($request->hasFile('thumbnail')){
            $path = $request->file('thumbnail')->store('thumbnails');

            if($post->image){
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->create([
                    'path' => $path
                ]);
            }
            
        }
        

        $request->session()->flash('status', 'Post was edited!');

        return redirect()->route('posts.show',['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize($post);

        $post->delete();

        $posts = Post::all();

        session()->flash('status-del', 'Post was deleted!');

        return redirect()->route('posts.index', ['posts' => $posts]);
    }
}
