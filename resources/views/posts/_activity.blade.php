{{-- the most commented posts --}}
{{-- <x-card title="Most Commented Posts" :items="collect($mostCommented)->pluck('title', 'comment_count')" /> --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Most Commented Posts</h4>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($mostCommented as $post)
            <li class="list-group-item">
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="color: black;">
                    {{ $post->title }}
                </a>
                <span class="text-muted">({{ $post->comment_count }})</span>
            </li>
        @endforeach
    </ul>
</div>
{{-- the most active user --}}
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Most Active Users</h4>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($mostActive as $user)
            <li class="list-group-item">
                {{ $user->name }}
                <span class="text-muted">({{ $user->blog_post_count }})</span>
            </li>
        @endforeach
    </ul>
</div>
{{-- the most active user in last month --}}
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Most Active User Last Month</h4>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($mostActiveLastMonth as $user)
            <li class="list-group-item">
                {{ $user->name }}
                <span class="text-muted">({{ $user->blog_post_count }})</span>
            </li>
        @endforeach
    </ul>
</div>
            