@extends('layout.app')

@section('title', 'Create post Post')

@section('content')
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<h1 class="text-lg text-center">Create a new post</h1>
@include('posts.partials.form')
</form>
@endsection