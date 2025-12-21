@props([
    'label' => null,
    'name' => null,
    'description' => null,
    'required' => false,
])

@php
    $inputId = $name ?? uniqid('field-');
    $hasError = $name && $errors->has($name);
@endphp

<div {{ $attributes->class(['w-full']) }}>
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

    {{-- Field content --}}
    {{ $slot }}

    {{-- Error message --}}
    @if($hasError)
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
            {{ $errors->first($name) }}
        </p>
    @endif
</div>
