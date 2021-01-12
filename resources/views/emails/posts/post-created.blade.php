@component('mail::message')
# Hi {{ $user->name }}

New Post was created, make sure to review it !

@component('mail::button', ['url' => route('posts.show', ['post' => $post->id])])
View post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
