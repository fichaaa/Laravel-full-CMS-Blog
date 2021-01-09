@extends('layout.app')

@section('title', 'Home')

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <h1 class="text-xl text-center mb-6">Registration form</h1>
    <div class="mb-3">
        <label for="" class="sr-only">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg p-3 bg-indigo-100 outline-none  @error('name') border-red-500 border @enderror" placeholder="Enter name">

        @error('name')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

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

    <div class="mb-3">
        <label class="sr-only">Retyped Password</label>
        <input type="password" name="password_confirmation"  required class="w-full rounded-lg p-3 bg-indigo-100 outline-none" placeholder="Confirm password">
    </div>

    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-lg font-sans uppercase focus:outline-none">Register</button>

    </form>
@endsection