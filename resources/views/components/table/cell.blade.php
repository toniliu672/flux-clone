@props([
    'header' => false,
    'sortable' => null,
    'align' => null,
    'width' => null,
])

@php
    $tag = $header ? 'th' : 'td';
    
    $alignClasses = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
    
    $widthClasses = $width ? "w-[$width]" : '';

    $baseClasses = \FluxClone\FluxClone::classes(
        'whitespace-nowrap',
        $alignClasses,
        $widthClasses,
    )
    ->when($header,
        'px-6 py-3 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-800/50',
        'px-6 py-4 text-sm text-zinc-900 dark:text-zinc-100 [table[data-compact="true"]_&]:py-2 [table[data-compact="true"]_&]:px-4'
    );
@endphp

<{{ $tag }} 
    {{ $attributes->class($baseClasses) }}
    @if($width) style="width: {{ $width }}" @endif
>
    @if($sortable && $header)
        <button
            type="button"
            x-on:click="
                if (sortBy === '{{ $sortable }}') {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortBy = '{{ $sortable }}';
                    sortDirection = 'asc';
                }
                $dispatch('sort', { column: sortBy, direction: sortDirection });
            "
            class="group inline-flex items-center gap-1.5 hover:text-zinc-700 dark:hover:text-zinc-200 transition-colors"
        >
            <span>{{ $slot }}</span>
            
            {{-- Sort indicator --}}
            <span class="flex flex-col" x-cloak>
                {{-- Ascending arrow --}}
                <svg 
                    class="size-3 -mb-0.5 transition-colors"
                    :class="sortBy === '{{ $sortable }}' && sortDirection === 'asc' 
                        ? 'text-zinc-900 dark:text-zinc-100' 
                        : 'text-zinc-300 dark:text-zinc-600 group-hover:text-zinc-400'"
                    fill="currentColor" 
                    viewBox="0 0 20 20"
                >
                    <path d="M5 10l5-5 5 5H5z"/>
                </svg>
                {{-- Descending arrow --}}
                <svg 
                    class="size-3 transition-colors"
                    :class="sortBy === '{{ $sortable }}' && sortDirection === 'desc' 
                        ? 'text-zinc-900 dark:text-zinc-100' 
                        : 'text-zinc-300 dark:text-zinc-600 group-hover:text-zinc-400'"
                    fill="currentColor" 
                    viewBox="0 0 20 20"
                >
                    <path d="M5 10l5 5 5-5H5z"/>
                </svg>
            </span>
        </button>
    @else
        {{ $slot }}
    @endif
</{{ $tag }}>
