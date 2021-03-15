@extends('layout')

@section('title')
    Blog
@endsection

@section('content')
    @forelse ($posts as $post)
        <h4><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h4>
        <p>{{ $post->description }}</p>
        @if ($post->comment_count)
            <p>{{ $post->comment_count }} comments</p>
        @else
            <p>No comments yet!</p>
        @endif
    @empty
        <p>No Post!!</p>
    @endforelse
@endsection