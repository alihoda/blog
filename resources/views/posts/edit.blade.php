@extends('layout')

@section('title')
    Edit
@endsection

@section('content')
    <br>
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('PUT')
        @include('posts._form')

        <button type="submit">Update</button>
    </form>

@endsection