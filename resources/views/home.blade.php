@extends('layouts.app')

@section('title')
    Home
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-between">
        @forelse ($posts as $post)
            <div class="col-md-4">
                <div class="card" style="margin-bottom: 1rem;">
                    <div class="card-header"><a href="{{ route('posts.show', ['post' => $post->id]) }}" style="color: black;">{{ $post->title }}</a></div>
                    
                    <div class="card-body">
                        <p>{{ $post->description }}</p>
                        @if ($post->comment_count)
                            <p class="text-muted">{{ $post->comment_count }} comments</p>
                        @else
                            <p class="text-muted">No comments yet!</p>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <p>No Post!!</p>
        @endforelse
    </div>
</div>
@endsection
