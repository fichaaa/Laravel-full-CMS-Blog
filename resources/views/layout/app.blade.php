<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel App - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="flex justify-between bg-gray-100 p-3 mb-6">
        <ul class="flex">
            <li class="px-2"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="px-2"><a href="{{ route('home.contact') }}">Contact</a></li>
         </ul>

         <ul class="flex">
            <li class="px-2"><a href="{{ route('posts.index') }}">Posts</a></li>
            @guest
            
            <li class="px-2"><a href="{{ route('register') }}">Register</a></li>
            <li class="px-2"><a href="{{ route('login') }}">Login</a></li>

            @else
            <li class="px-2"><a href="{{ route('posts.create') }}">Add Post</a></li>
                <form class="inline-block" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-2 focus:outline-none">Logout ({{ (Auth::user()->name) }})</button>
                </form>
            @endguest
         </ul>
    </nav>
    <div class="bg-gray-100 rounded-lg w-8/12 m-auto p-6">
        @if(session('status'))
            <div class="text-green-400">{{ session('status') }}</div>
        @elseif(session('status-del'))
            <div class="text-red-400">{{ session('status-del') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>