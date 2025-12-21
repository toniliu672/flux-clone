@props([
    'sticky' => true,
])

<header 
    {{ $attributes->class([
        'w-full border-b border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900',
        'sticky top-0 z-40' => $sticky,
    ]) }}
>
    <div class="flex h-16 items-center justify-between px-4">
        {{ $slot }}
    </div>
</header>
