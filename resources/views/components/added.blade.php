@props(['date', 'name', 'userId'])

<span class="card-subtitle text-muted">
    {{ empty(trim($slot)) ? 'Added' : $slot }} {{ $date->diffForHumans() }}
    @if (isset($name))
        @if (isset($userId))
            by <a href="{{ route('users.show', ['user' => $userId]) }}">{{ $name }}</a>
        @else
            by {{ $name }}
        @endif
    @endif
</span>