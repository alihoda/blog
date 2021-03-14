<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=chrome">
    <title>@yield('title')</title>
</head>
<header>
    <nav>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('posts.index') }}">Blog Posts</a></li>
        <li><a href="{{ route('posts.create') }}">Create Post</a></li>
    </nav>
</header>
<body>

    @if (session()->has('status'))
        <p style="color: green">{{ session()->get('status') }}</p>
    @endif

    @yield('content')
</body>

<script src="{{ asset('js/app.js') }}" defer></script>
</html>