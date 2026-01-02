@props([
    'disabled' => false,
])

<label {{ $attributes->class([
    'block text-sm font-medium text-zinc-700 dark:text-zinc-300',
    'opacity-50' => $disabled,
]) }}>
    {{ $slot }}
</label>
