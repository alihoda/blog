@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="row">
        {{-- posts --}}
        <div class="col-9">
            <div class="row justify-content-start">
                @forelse ($posts as $post)
                    <div class="col-md-4 d-flex p-2">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="color: black;">
                                    {{ $post->title }}
                                </a>
                            </div>
                            
                            <div class="card-body">
                                <p>{{ $post->description }}</p>
                            </div>
                            {{-- card footer --}}
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
        <div class="col-3 p-2">
            {{-- the most commented posts --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Most Commented Posts</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($mostCommented as $post)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="color: black;">
                                {{ $post->title }}
                            </a>
                            <span class="text-muted">({{ $post->comment_count }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- the most active user --}}
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title">Most Active Users</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($mostActive as $user)
                        <li class="list-group-item">
                            {{ $user->name }}
                            <span class="text-muted">({{ $user->blog_post_count }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- the most active user in last month --}}
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title">Most Active User Last Month</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($mostActiveLastMonth as $user)
                        <li class="list-group-item">
                            {{ $user->name }}
                            <span class="text-muted">({{ $user->blog_post_count }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
