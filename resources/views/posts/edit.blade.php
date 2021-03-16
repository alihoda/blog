@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Post</a></div>
                
                <div class="card-body">
                    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('posts._form')
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection