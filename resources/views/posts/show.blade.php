@extends('layouts.app')

@section('title')
Blog
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                {{-- card header --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ $post->title }}</h4>
                    <div>
                        <x-added :date="$post->created_at" :name="$post->user->name" />
                        {{-- badge for new posts --}}
                        <x-badge type="success" :show="now()->diffInMinutes($post->created_at) < 30">
                            New
                        </x-badge>
                    </div>
                </div>
                <div class="card-body">
                    {{-- description --}}
                    <p>{{ $post->description }}</p>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Read by {{ $counter }} people</span>
                        <span>
                            <x-tags :tags="$post->tags" /></span>
                    </div>
                    <hr>
                    {{-- comment section --}}
                    @include('comments._form')
                    <ul class="list-group">
                        @forelse ($post->comment as $comment)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $comment->content }}
                            <x-added :date="$comment->created_at" :name="$comment->user->name" />
                        </li>
                        @empty
                        <p>No comment yet!</p>
                        @endforelse
                    </ul>
                </div>
                {{-- card footer --}}
                @auth
                <div class="card-footer d-flex justify-content-between align-items-center">
                    @can('update', $post)
                    <a class="btn btn-outline-primary col-sm-2" href="{{ route('posts.edit', ['post' => $post]) }}"
                        role="button">Edit</a>
                    @endcan
                    @can('delete', $post)
                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                    @endcan
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection