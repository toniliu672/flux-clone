@props([])

<nav {{ $attributes->class([
    'flex items-center gap-4',
]) }}>
    {{ $slot }}
</nav>
