@extends('layouts.app')

@section('title')
    Blog
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ $post->title }}</h4>
                    <span class="card-subtitle text-muted">Added {{ $post->created_at->diffForHumans() }}</span>
                </div>
                <div class="card-body">
                    <p>{{ $post->description }}</p>
                    <hr>
                    <ul class="list-group">
                        @forelse ($post->comment as $comment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $comment->content }}
                                <span class="card-subtitle text-muted">Added {{ $comment->created_at->diffForHumans() }}</span>
                            </li>
                            @empty
                            <p>No comment yet!</p>
                            @endforelse
                        </div>    
                    </ul> 
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="btn btn-outline-primary" href="{{ route('posts.edit', ['post' => $post]) }}" role="button">Edit</a>
                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>    
@endsection