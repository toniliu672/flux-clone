@props([
    'href' => null,
    'icon' => null,
    'active' => false,
])

@php
    $isActive = $active || ($href && request()->url() === url($href));
    
    $classes = \FluxClone\FluxClone::classes(
        'flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition-colors',
    )
    ->when($isActive, 
        'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-100',
        'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/50 dark:hover:text-zinc-100'
    );
@endphp

<a href="{{ $href ?? '#' }}" {{ $attributes->class($classes) }}>
    @if($icon)
        <x-flux-clone::icon :name="$icon" class="size-5 shrink-0" />
    @endif
    <span>{{ $slot }}</span>
</a>
