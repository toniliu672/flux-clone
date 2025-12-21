@props([
    'name',
    'label' => null,
    'sortable' => false,
    'searchable' => false,
    'align' => null,
    'width' => null,
    'hidden' => false,
])

@php
    $label = $label ?? ucfirst(str_replace('_', ' ', $name));
    
    $alignClasses = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
@endphp

@if(!$hidden)
    <th 
        {{ $attributes->class([
            'px-6 py-3 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400',
            $alignClasses,
        ]) }}
        @if($width) style="width: {{ $width }}" @endif
    >
        @if($sortable)
            <button
                type="button"
                x-on:click="sort('{{ $name }}')"
                class="group inline-flex items-center gap-1.5 hover:text-zinc-700 dark:hover:text-zinc-200 transition-colors"
            >
                <span>{{ $label }}</span>
                
                {{-- Sort indicator --}}
                <span class="flex flex-col" x-cloak>
                    <svg 
                        class="size-3 -mb-0.5 transition-colors"
                        :class="sortBy === '{{ $name }}' && sortDirection === 'asc' 
                            ? 'text-zinc-900 dark:text-zinc-100' 
                            : 'text-zinc-300 dark:text-zinc-600 group-hover:text-zinc-400'"
                        fill="currentColor" 
                        viewBox="0 0 20 20"
                    >
                        <path d="M5 10l5-5 5 5H5z"/>
                    </svg>
                    <svg 
                        class="size-3 transition-colors"
                        :class="sortBy === '{{ $name }}' && sortDirection === 'desc' 
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
            {{ $label }}
        @endif
    </th>
@endif
