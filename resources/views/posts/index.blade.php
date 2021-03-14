@extends('layout')

@section('title')
    Blog
@endsection

@section('content')
    @forelse ($posts as $post)
        <h4><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h4>
    @empty
        <p>No Post!!</p>
    @endforelse
@endsection