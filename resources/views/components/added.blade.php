@props(['date', 'name'])

<span class="card-subtitle text-muted">
    {{ empty(trim($slot)) ? 'Added' : $slot }} {{ $date->diffForHumans() }}
    @if (isset($name))
        by {{ $name }}
    @endif
</span>