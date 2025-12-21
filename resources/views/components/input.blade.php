@props([
    'type' => 'text',
    'name' => null,
    'label' => null,
    'placeholder' => null,
    'value' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'viewable' => false,
    'autocomplete' => null,
    'description' => null,
])

@php
    $inputId = $name ?? uniqid('input-');
    $hasError = $name && $errors->has($name);
    
    $inputClasses = \FluxClone\FluxClone::classes(
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
    ->when($viewable && $type === 'password', 'pr-10');
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

    {{-- Input wrapper --}}
    <div class="relative">
        <input
            type="{{ $viewable ? 'password' : $type }}"
            id="{{ $inputId }}"
            @if($name) name="{{ $name }}" @endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($value) value="{{ $value }}" @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            {{ $attributes->class($inputClasses) }}
            @if($viewable)
                x-data="{ show: false }"
                x-bind:type="show ? 'text' : 'password'"
            @endif
        />

        {{-- Password visibility toggle --}}
        @if($viewable && $type === 'password')
            <button
                type="button"
                x-data="{ show: false }"
                @click="show = !show; $el.previousElementSibling.type = show ? 'text' : 'password'"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300"
            >
                {{-- Eye icon (show password) --}}
                <svg x-show="!show" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{-- Eye-slash icon (hide password) --}}
                <svg x-show="show" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
            </button>
        @endif
    </div>

    {{-- Error message --}}
    @if($hasError)
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
            {{ $errors->first($name) }}
        </p>
    @endif
</div>
