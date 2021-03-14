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

    <a href="{{ route('posts.edit', ['post' => $post]) }}">Edit the Post</a>
    <br><br>
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection