@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'checked' => false,
    'disabled' => false,
    'description' => null,
])

@php
    $inputId = $name ? $name . ($value ? '-' . $value : '') : uniqid('checkbox-');
@endphp

<div class="flex items-start gap-3">
    <div class="flex h-6 items-center">
        <input
            type="checkbox"
            id="{{ $inputId }}"
            @if($name) name="{{ $name }}" @endif
            @if($value) value="{{ $value }}" @endif
            @checked($checked)
            @disabled($disabled)
            {{ $attributes->class([
                'size-4 rounded border-zinc-300 text-zinc-900 shadow-sm transition',
                'focus:ring-2 focus:ring-zinc-500/20 focus:ring-offset-0',
                'disabled:opacity-50 disabled:cursor-not-allowed',
                'dark:border-zinc-600 dark:bg-zinc-900 dark:text-white dark:checked:bg-white dark:checked:border-white',
            ]) }}
        />
    </div>

    @if($label || $description)
        <div class="text-sm leading-6">
            @if($label)
                <label for="{{ $inputId }}" class="font-medium text-zinc-900 dark:text-zinc-100 {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}">
                    {{ $label }}
                </label>
            @endif
            @if($description)
                <p class="text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
            @endif
        </div>
    @endif
</div>
