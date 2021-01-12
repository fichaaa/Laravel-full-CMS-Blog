@extends('layout.app')


@section('title', 'Posts')

@section('content')

<div class="grid grid-cols-12 gap-4">
    <div class="col-span-8">
            @forelse ($posts as $post)
            <div class="mb-4">
               
                <a class="text-lg {{ $post->trashed() ? 'text-gray-300' : 'text-blue-300' }} hover:text-blue-500 hover:underline cursor-pointer mb-2 inline-block " href="{{ route('posts.show',['post' => $post->id]) }}">
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
            
                <p class="mb-1">{{ $post->content }}</p>
                <x-tags :tags="$post->tags"></x-tags>
                <x-update :item="$post"></x-update>
                <p class="text-gray-400">{{ trans_choice('messages.comments', $post->comments_count) }}</p>
            </div>
        @empty
            <p>No posts found.</p>
        @endforelse
    </div>

    <div class="col-span-4">
        @include('posts.partials.cards')

    </div>
</div>



@endsection

