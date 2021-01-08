@extends('layout.app')


@section('title', 'Single Post')

@section('content')
<div class="mb-4">
    
    <a class="text-lg text-blue-300 hover:text-blue-500 hover:underline cursor-pointer inline-block mb-2" href="{{ route('posts.show',['post' => $post->id]) }}">{{ $post->title }}</a>
    <x-badge type="bg-green-500" :show="now()->diffInMinutes($post->created_at) < 40">
        Brand new Post
    </x-badge>
    <p class="">{{ $post->content }}</p>
    <x-update :item="$post"></x-update>
    <div class="my-2">  
        <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="bg-blue-400 hover:bg-blue-500 py-2 px-3 text-white rounded-md inline-block">Edit Post</a>
        <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-400 hover:bg-red-500 py-2 px-3 text-white rounded-md inline-block">Delete Post</button>
        </form>
    </div>
</div>
            <div class="my-3">
                <h1>Comments</h1>
                <hr>
                @forelse ($post->comments as $comment)
                    <div class="mb-3">
                        <p >{{ $comment->content }}</p>
                        <x-update :item="$comment"></x-update>
                    </div>
                @empty
                    <p>No comments yet!</p>
                @endforelse
            </div>
   

@endsection