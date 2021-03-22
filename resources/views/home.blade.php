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
                    <div class="card flex-fill">
                        <div class="card-header">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="color: black;">
                                {{ $post->title }}
                            </a>
                        </div>

                        <div class="card-body">
                            <p>{{ $post->description }}</p>
                        </div>
                        {{-- tags --}}
                        <div class="card-body d-flex align-items-end">
                            <x-tags :tags="$post->tags" />
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
                            <span class="card-subtitle text-muted">
                                <a href="{{ route('users.show', ['user'=>$post->user->id]) }}">{{ $post->user->name }}</a>
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                    <p>No Post!!</p>
                @endforelse
            </div>
        </div>
        {{-- Activity section --}}
        <div class="col-3 p-2">
            @include('posts._activity')
        </div>
    </div>
</div>
@endsection