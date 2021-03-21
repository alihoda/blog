<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title ?? null) }}">
</div>
<div class="form-group">
    <label for="description">Descritpion</label>

    <textarea class="form-control" name="description" id="description" rows="5">
    {{ old('description', $post->description ?? null) }}
  </textarea>
</div>
<x-errors />