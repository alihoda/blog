@extends('layouts.app')

@section('title')
    Home
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-between equal">
        @forelse ($posts as $post)
            <div class="col-md-4 d-flex pb-3">
                <div class="card" style="margin-bottom: 1rem;">
                    <div class="card-header"><a href="{{ route('posts.show', ['post' => $post->id]) }}" style="color: black;">{{ $post->title }}</a></div>
                    
                    <div class="card-body">
                        <p>{{ $post->description }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span class="card-subtitle text-muted">
                            @if ($post->comment_count)
                                {{ $post->comment_count }} comments
                            @else
                                No comments yet!
                            @endif
                        </span>
                        <span class="card-subtitle text-muted">{{ $post->user->name }}</span>
                    </div>

                </div>
            </div>
        @empty
            <p>No Post!!</p>
        @endforelse
    </div>
</div>
@endsection
