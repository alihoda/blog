<h3>Hello {{$comment->commentable->user->name}}</h3>

<p>
    You have a new comment on your blog post: 
    <a href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">
        {{$comment->commentable->title}}
    </a>
</p>
<div>
    {{-- <img src="{{ $message->embed($comment->user->image->url()) }}" alt="User Profile"> --}}
    <p>
        Commented by 
        <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
    </p>
</div>
