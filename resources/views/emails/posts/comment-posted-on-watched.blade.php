@component('mail::message')
# Hi {{ $user->name }}

Someone posted on post you watched - {{ $comment->commentable->title }}.

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View Post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
View {{ $comment->user->name }} Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
