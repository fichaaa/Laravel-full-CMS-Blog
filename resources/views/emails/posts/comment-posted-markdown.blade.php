@component('mail::message')
# Hi {{ $comment->commentable->user->name }}

Someone Posted on your post - {{ $comment->commentable->title }}

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View Post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
View {{ $comment->user->name }} Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
