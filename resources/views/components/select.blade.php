@props([
    'name' => null,
    'label' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'searchable' => false,
    'description' => null,
])

@php
    $inputId = $name ?? uniqid('select-');
    $hasError = $name && $errors->has($name);
    
    $selectClasses = \FluxClone\FluxClone::classes(
        'block w-full rounded-lg border bg-white px-3 py-2 pr-10 text-sm text-zinc-900 shadow-sm transition-colors appearance-none',
        'focus:outline-none focus:ring-2 focus:ring-offset-0',
        'disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-zinc-50',
        'dark:bg-zinc-900 dark:text-zinc-100',
    )
    ->when($hasError, 
        'border-red-500 focus:border-red-500 focus:ring-red-500/20 dark:border-red-400',
        'border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500/20 dark:border-zinc-700 dark:focus:border-zinc-500'
    );
@endphp

<div class="w-full">
    {{-- Label --}}
    @if($label)
        <label for="{{ $inputId }}" class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Description --}}
    @if($description)
        <p class="mb-1.5 text-sm text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
    @endif

    {{-- Select wrapper --}}
    <div class="relative">
        <select
            id="{{ $inputId }}"
            @if($name) name="{{ $name }}" @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            {{ $attributes->class($selectClasses) }}
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            {{ $slot }}
        </select>

        {{-- Dropdown arrow --}}
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="size-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    {{-- Error message --}}
    @if($hasError)
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
            {{ $errors->first($name) }}
        </p>
    @endif
</div>
