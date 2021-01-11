@extends('layout.app')

@section('title', 'Edit Post')

@section('content')
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<h1 class="text-lg text-center">Edit post</h1>
@include('posts.partials.form')
</form>
@endsection