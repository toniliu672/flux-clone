@props([])

<tbody {{ $attributes->class([
    'divide-y divide-zinc-200 bg-white dark:divide-zinc-700 dark:bg-zinc-900',
]) }}>
    {{ $slot }}
</tbody>
