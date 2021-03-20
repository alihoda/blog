@props(['tags'])

<p>
    @foreach ($tags as $tag)
    <a href="{{ route('post-tags', ['tag' => $tag->id]) }}" class="badge badge-success">
        {{ $tag->name }}
    </a>
    @endforeach
</p>