@component('mail::message')
# New comment on {{$comment->commentable->title}} you're watching

Hello {{$user->name}}

Commented by {{ $comment->user->name }}
@component('mail::panel')
{{ $comment->content }}
@endcomponent

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
Blog Post Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
