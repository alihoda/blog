@extends('layouts.app')

@section('title')
    Contact
@endsection

@section('content')
<div class="container">
        <div class="jumbotron">
            <h1 class="display-3">Contact</h1>
            <p class="lead">Here is our contact page!</p>
            @can('home.contact')
                <hr class="my-2">
                <p>More info</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Some Action</a>
                </p>
            @endcan
        </div>
    </div>
@endsection
