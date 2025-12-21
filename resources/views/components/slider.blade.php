@props([
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => 0,
    'showValue' => true,
])

<div 
    x-data="{ value: {{ $value }} }"
    {{ $attributes->class(['flex items-center gap-4']) }}
>
    <input
        type="range"
        x-model="value"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        class="w-full h-2 bg-zinc-200 rounded-lg appearance-none cursor-pointer dark:bg-zinc-700 accent-zinc-900 dark:accent-zinc-100"
    />
    
    @if($showValue)
        <span 
            x-text="value"
            class="min-w-12 text-sm font-medium text-zinc-900 dark:text-zinc-100 text-right"
        ></span>
    @endif
</div>
