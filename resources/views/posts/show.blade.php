@extends('layout.app')

@section('title', 'Single Post')

@section('content')
<div class="grid grid-cols-12 gap-4"> 

<div class="col-span-8">
    <div class="mb-4">
        <div class="h-48 w-full rounded-sm bg-cover bg-no-repeat bg-center mb-3" style="background-image:url('{{ $post->image ? $post->image->url() : null }}')">

        </div>
        <a class="text-lg {{ $post->trashed() ? 'text-gray-300' : 'text-blue-300' }} hover:text-blue-500 hover:underline cursor-pointer inline-block mb-2" href="{{ route('posts.show',['post' => $post->id]) }}">
            @if($post->trashed())
            <del>
            @endif
                {{ $post->title }}
            @if($post->trashed())
            </del>
            @endif
        </a>
        <x-badge type="bg-green-500" :show="now()->diffInMinutes($post->created_at) < 40">
            Brand new Post
        </x-badge>
        <p class="">{{ $post->content }}</p>
        <x-tags :tags="$post->tags"></x-tags>
        <x-update :item="$post"></x-update>
        <p>Currently read by {{ $counter }} people</p>
        @auth
        <div class="my-2">  
            @can('update', $post)
                <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="bg-blue-400 hover:bg-blue-500 py-2 px-3 text-white rounded-md inline-block">Edit Post</a>
            @endcan
            @can('delete', $post)
                <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-400 hover:bg-red-500 py-2 px-3 text-white rounded-md inline-block">Delete Post</button>
                </form>
            @endcan
        </div>
        @endauth
    </div>
        <div class="my-3">
            <h1>Comments</h1>
            <hr>
            <x-comment-form :route="route('posts.comments.store', ['post' => $post->id])"></x-comment-form>
            <x-comment-list :comments="$post->comments"></x-comment-list>
        </div>
    </div>
    <div class="col-span-4">
        @include('posts.partials.cards')
    </div>

</div>
@endsection