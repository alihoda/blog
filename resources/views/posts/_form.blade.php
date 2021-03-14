<label for="title">Title</label>
<input type="text" id="title" name="title" value="{{ old('title', $post->title ?? null) }}">
<label for="description">Description</label>
<input type="text" id="description" name="description" value="{{ old('description', $post->description ?? null) }}">

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
        <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif