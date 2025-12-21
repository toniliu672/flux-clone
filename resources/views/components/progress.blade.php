@props([
    'value' => 0,
    'max' => 100,
    'size' => 'md',
    'color' => null,
    'showValue' => false,
    'indeterminate' => false,
])

@php
    $percentage = ($value / $max) * 100;
    
    $sizeClasses = match ($size) {
        'sm' => 'h-1',
        'lg' => 'h-4',
        default => 'h-2',
    };

    $colorClasses = match ($color) {
        'success' => 'bg-green-500',
        'warning' => 'bg-yellow-500',
        'danger' => 'bg-red-500',
        'info' => 'bg-blue-500',
        default => 'bg-zinc-900 dark:bg-zinc-100',
    };
@endphp

<div {{ $attributes->class(['w-full']) }}>
    <div class="overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-700 {{ $sizeClasses }}">
        @if($indeterminate)
            <div class="h-full {{ $colorClasses }} animate-indeterminate-progress"></div>
        @else
            <div 
                class="h-full rounded-full transition-all duration-300 {{ $colorClasses }}"
                style="width: {{ $percentage }}%"
                role="progressbar"
                aria-valuenow="{{ $value }}"
                aria-valuemin="0"
                aria-valuemax="{{ $max }}"
            ></div>
        @endif
    </div>
    
    @if($showValue && !$indeterminate)
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400 text-right">
            {{ number_format($percentage, 0) }}%
        </p>
    @endif
</div>

<style>
@keyframes indeterminate-progress {
    0% { transform: translateX(-100%); width: 50%; }
    100% { transform: translateX(200%); width: 50%; }
}
.animate-indeterminate-progress {
    animation: indeterminate-progress 1.5s infinite ease-in-out;
}
</style>
