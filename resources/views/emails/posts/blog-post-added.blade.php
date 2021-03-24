@component('mail::message')
# New Blog Post Has Been Created

{{ $blogPost->title }} was created {{ $blogPost->created_at->diffForHumans()}} by {{ $blogPost->user->name }}

@component('mail::button', ['url' => route('posts.show', ['post' => $blogPost->id])])
View The Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
