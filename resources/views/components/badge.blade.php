@props([
    'color' => 'zinc',
    'size' => 'base',
    'variant' => 'solid',
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'text-xs px-1.5 py-0.5',
        'lg' => 'text-sm px-3 py-1',
        default => 'text-xs px-2 py-0.5',
    };

    $colorClasses = match ($variant) {
        'solid' => match ($color) {
            'green' => 'bg-green-500 text-white dark:bg-green-600',
            'red' => 'bg-red-500 text-white dark:bg-red-600',
            'blue' => 'bg-blue-500 text-white dark:bg-blue-600',
            'yellow' => 'bg-yellow-500 text-white dark:bg-yellow-600',
            'purple' => 'bg-purple-500 text-white dark:bg-purple-600',
            'pink' => 'bg-pink-500 text-white dark:bg-pink-600',
            'indigo' => 'bg-indigo-500 text-white dark:bg-indigo-600',
            'orange' => 'bg-orange-500 text-white dark:bg-orange-600',
            'teal' => 'bg-teal-500 text-white dark:bg-teal-600',
            'cyan' => 'bg-cyan-500 text-white dark:bg-cyan-600',
            default => 'bg-zinc-500 text-white dark:bg-zinc-600',
        },
        'outline' => match ($color) {
            'green' => 'border border-green-500 text-green-600 dark:border-green-400 dark:text-green-400',
            'red' => 'border border-red-500 text-red-600 dark:border-red-400 dark:text-red-400',
            'blue' => 'border border-blue-500 text-blue-600 dark:border-blue-400 dark:text-blue-400',
            'yellow' => 'border border-yellow-500 text-yellow-600 dark:border-yellow-400 dark:text-yellow-400',
            'purple' => 'border border-purple-500 text-purple-600 dark:border-purple-400 dark:text-purple-400',
            'pink' => 'border border-pink-500 text-pink-600 dark:border-pink-400 dark:text-pink-400',
            'indigo' => 'border border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400',
            'orange' => 'border border-orange-500 text-orange-600 dark:border-orange-400 dark:text-orange-400',
            'teal' => 'border border-teal-500 text-teal-600 dark:border-teal-400 dark:text-teal-400',
            'cyan' => 'border border-cyan-500 text-cyan-600 dark:border-cyan-400 dark:text-cyan-400',
            default => 'border border-zinc-500 text-zinc-600 dark:border-zinc-400 dark:text-zinc-400',
        },
        'pill' => match ($color) {
            'green' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
            'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
            'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'yellow' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
            'purple' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
            'pink' => 'bg-pink-100 text-pink-700 dark:bg-pink-900/30 dark:text-pink-400',
            'indigo' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400',
            'orange' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
            'teal' => 'bg-teal-100 text-teal-700 dark:bg-teal-900/30 dark:text-teal-400',
            'cyan' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-400',
            default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
        },
        default => match ($color) {
            'green' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
            'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
            'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'yellow' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
            'purple' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
            'pink' => 'bg-pink-100 text-pink-700 dark:bg-pink-900/30 dark:text-pink-400',
            'indigo' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400',
            'orange' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
            'teal' => 'bg-teal-100 text-teal-700 dark:bg-teal-900/30 dark:text-teal-400',
            'cyan' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-400',
            default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
        },
    };

    $roundedClass = $variant === 'pill' ? 'rounded-full' : 'rounded-md';

    $classes = \FluxClone\FluxClone::classes(
        'inline-flex items-center font-medium',
        $sizeClasses,
        $colorClasses,
        $roundedClass,
    );
@endphp

<span {{ $attributes->class($classes) }}>
    {{ $slot }}
</span>
