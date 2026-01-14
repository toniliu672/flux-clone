@props([
    'name' => null,
    'label' => null,
    'placeholder' => null,
    'value' => null,
    'rows' => 3,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'resize' => true,
    'description' => null,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $fieldName = $name ?? $wireModel;
    $inputId = $fieldName ?? uniqid('textarea-');
    $hasError = $fieldName && $errors->has($fieldName);
    
    $textareaClasses = \FluxClone\FluxClone::classes(
        'block w-full rounded-lg border bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm transition-colors',
        'placeholder:text-zinc-400',
        'focus:outline-none focus:ring-2 focus:ring-offset-0',
        'disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-zinc-50',
        'dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder:text-zinc-500',
    )
    ->when($hasError, 
        'border-red-500 focus:border-red-500 focus:ring-red-500/20 dark:border-red-400',
        'border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500/20 dark:border-zinc-700 dark:focus:border-zinc-500'
    )
    ->unless($resize, 'resize-none');
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

    {{-- Textarea --}}
    <textarea
        id="{{ $inputId }}"
        @if($name) name="{{ $name }}" @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        rows="{{ $rows }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        {{ $attributes->class($textareaClasses) }}
    >{{ $value ?? $slot }}</textarea>

    {{-- Error message --}}
    @if($hasError)
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
            {{ $errors->first($fieldName) }}
        </p>
    @endif
</div>
