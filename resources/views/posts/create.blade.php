@extends('layout')

@section('title')
    Create
@endsection

@section('content')
    <br>
    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        @include('posts._form')
        <button type="submit">Create</button>
    </form>
@endsection