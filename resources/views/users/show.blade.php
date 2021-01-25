@extends('layout.app')

@section('title', 'Show user')

@section('content')

    <div class="grid grid-cols-12 gap-4"> 
        <div class="col-span-4 flex flex-col items-center">
            <div class="w-24 h-24 border-2 border-gray-200 bg-center bg-cover bg-no-repeat" style="background-image:url('{{ $user->image ? $user->image->url() : '' }}')"></div>
            <div>     
            </div>
        </div>

        <div class="col-span-8">
            <div>
                <h1>{{ $user->name }}</h1>
            </div>
            <p>Currently viewed by {{ $counter }} users</p>
            @can('update', $user)
            <a href="{{ route('users.edit',['user' => $user->id]) }}" class="bg-blue-400 hover:bg-blue:500 text-white rounded-sm py-1 px-3 my-2 inline-block">Edit User</a>
            @endcan
           
            <p>Comments</p>
            <hr>
            <x-comment-form :route="route('users.comments.store', ['user' => $user->id])"></x-comment-form>
            <x-comment-list :comments="$user->commentsOn"></x-comment-list>
        </div>

      
    </div>
</from>
@endsection