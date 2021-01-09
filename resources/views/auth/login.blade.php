@extends('layout.app')


@section('title', 'Home')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <h1 class="text-xl text-center mb-6">Login form</h1>
    

    <div class="mb-3">
        <label class="sr-only">E-mail</label>
        <input type="text" name="email" value="{{ old('email') }}" required class="w-full rounded-lg p-3 bg-indigo-100 outline-none @error('email') border-red-500 border @enderror" placeholder="Enter e-mail">

        @error('email')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="sr-only">Password</label>
        <input type="password" name="password" required class="w-full rounded-lg p-3 bg-indigo-100 outline-none @error('password') border-red-500 border @enderror" placeholder="Enter password">

        @error('password')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3 flex items-center">
       
        <input type="checkbox" name="remember">
        <h1 class="ml-1">Remember me</h1>
       
    </div>

    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-lg font-sans uppercase focus:outline-none">Login</button>
    </form>

@endsection