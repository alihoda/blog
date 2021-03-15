@extends('layout')

@section('title')
    Blog
@endsection

@section('content')
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->description }}</p>
    <p>Added {{ $post->created_at->diffForHumans() }}</p>

    @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
        <strong>New!</strong>
    @endif

    <h4>Comments</h4>
    @forelse ($post->comment as $comment)
        <p>{{ $comment->content }}, added {{ $comment->created_at->diffForHumans() }}</p>    
    @empty
        <p>No comment yet!</p>
    @endforelse
    <hr>
    <a href="{{ route('posts.edit', ['post' => $post]) }}">Edit the Post</a>
    <br><br>
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection