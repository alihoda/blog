@props(['type' => 'primary', 'show'])

@if (!isset($show) || $show)
    <span class="badge badge-{{ $type ?? 'primary'}}">
        {{ $slot }}
    </span>
@endif