

<div class="form-group">
  <label for="title">Title</label>
  <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title ?? null) }}">
</div>
<div class="form-group">
  <label for="description">Descritpion</label>
  <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $post->description ?? null) }}">
</div>

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
        <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif