@props(['comments'])

<ul class="list-group">
    @forelse ($comments as $comment)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $comment->content }}
            <x-added :date="$comment->created_at" :name="$comment->user->name" :userId="$comment->user->id" />
        </li>
    @empty
        <p>No comment yet!</p>
    @endforelse
</ul>