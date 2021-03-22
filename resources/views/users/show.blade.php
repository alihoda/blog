@extends('layouts.app')

@section('title')
{{ $user->name }} Profile
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex p-2">
            <div class="card flex-fill">
                <div class="card-body">
                    <h4 class="card-title">{{ $user->name }}</h4>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex p-2">
            <div class="card flex-fill align-items-center justify-content-center">
                @if (isset($user->image))
                <img class="card-img" src="{{ $user->image->url() }}" alt="{{ $user->name }}">
                @else
                    <h5 class="align-middle">No Avatar!!</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection