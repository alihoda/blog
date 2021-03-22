@extends('layouts.app')

@section('title')
Edit {{ $user->name }} Profile
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex p-2">
            <div class="card flex-fill">
                <div class="card-body">
                    <h4 class="card-title">Edit {{ $user->name }}</h4>
                    <form action="{{ route('users.update', ['user' => $user->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="avatar">Avatar</label>
                          <input type="file" class="form-control-file" name="avatar" id="avatar" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Update</button>
                    </form>
                    <x-errors />
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex p-2">
            <div class="card flex-fill align-items-center justify-content-center">
                @if (isset($user->image))
                    <img class="card-img" src="{{ $user->image->url() }}" alt="{{ $user->name }}">
                @else
                    <h5>No Avatar!!</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection