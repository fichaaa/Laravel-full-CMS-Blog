@extends('layout.app')

@section('title', 'Show user')

@section('content')
<form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-12 gap-4"> 
        <div class="col-span-4 flex flex-col items-center">
            <div class="w-24 h-24 border-2 border-gray-200 bg-center bg-cover bg-no-repeat" style="background-image:url('{{ $user->image ? $user->image->url() : '' }}')"></div>
            <div>
                <div class="bg-white rounded-sm p-3 my-2">
                    <h1 class="mb-2">Upload an avatar</h1>
                    <input type="file" name="avatar">
                </div>
                
            </div>
        </div>

        <div class="col-span-8">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" class="w-full py-1 px-3 my-1 rounded-sm bg-white" value="{{ old('name',$user->name ?? null) }}">
            </div>
            <x-errors></x-errors>
            <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white py-1 px-3 rounded-sm">Save changes</button>
        </div>
    </div>
</from>
@endsection