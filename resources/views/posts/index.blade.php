@extends('layout.app')


@section('title', 'Posts')

@section('content')

@forelse ($posts as $post)
    <div class="mb-4">
        <a class="text-lg text-blue-300 hover:text-blue-500 hover:underline cursor-pointer mb-2 inline-block " href="{{ route('posts.show',['post' => $post->id]) }}">{{ $post->title }}</a>
        <x-badge type="bg-green-500" :show="now()->diffInMinutes($post->created_at) < 40">
            Brand new Post
        </x-badge>
        <p class="mb-1">{{ $post->content }}</p>
        <x-update :item="$post"></x-update>
        @if($post->comments_count)
            {{ $post->comments_count }}  comment{{ Helper::plural($post->comments_count) }}
        @else
            No comments yet!
        @endif
    </div>
@empty
    <p>No posts found.</p>
@endforelse


@endsection