<div class="mb-2 mt-2">
    @auth
    <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="post">
        @csrf
        <textarea class="form-control" name="content" id="content" rows="3"></textarea>
        <button type="submit" class="btn btn-primary btn-block mt-1">Add Comment</button>
    </form>
    @else
    <a href="{{ route('login') }}">Login</a> to add comment!
    @endauth
</div>
<x-errors />
<hr>